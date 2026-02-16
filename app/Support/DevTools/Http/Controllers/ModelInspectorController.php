<?php

namespace App\Support\DevTools\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;

class ModelInspectorController extends Controller
{
    /**
     * List all Eloquent models in the application.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $models = $this->discoverModels();
        $modelData = [];

        foreach ($models as $modelClass) {
            try {
                $model = app($modelClass);
                $modelData[] = $this->getModelBasicInfo($model);
            } catch (\Exception $e) {
                // Skip models that can't be instantiated
                continue;
            }
        }

        return response()->json([
            'models' => $modelData,
            'count' => count($modelData),
        ]);
    }

    /**
     * Get detailed information about a specific model.
     *
     * @param  string  $modelName  Short class name (e.g., "User")
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($modelName)
    {
        $modelClass = $this->findModelClass($modelName);

        if ($modelClass === null) {
            return response()->json([
                'error' => "Model '{$modelName}' not found",
            ], 404);
        }

        try {
            $model = app($modelClass);
            $data = array_merge(
                $this->getModelBasicInfo($model),
                [
                    'attributes' => $this->getModelAttributes($model),
                    'relationships' => $this->getModelRelationships($model),
                    'schema' => $this->getTableSchema($model),
                ]
            );

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to inspect model: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Discover all Eloquent models in the domain Models directories.
     *
     * @return array<int, class-string<Model>>
     */
    private function discoverModels(): array
    {
        $models = [];

        // Scan app/Domain/*/Models/ directories
        $domainPath = app_path('Domain');
        if (File::isDirectory($domainPath)) {
            /** @var array<int, string> $domainDirs */
            $domainDirs = File::directories($domainPath);
            foreach ($domainDirs as $domainDir) {
                $modelsPath = $domainDir.'/Models';
                if (File::isDirectory($modelsPath)) {
                    $domainName = basename($domainDir);
                    $files = File::allFiles($modelsPath);
                    foreach ($files as $file) {
                        $className = 'App\\Domain\\'.$domainName.'\\Models\\'.str_replace(
                            ['/', '.php'],
                            ['\\', ''],
                            Str::after($file->getPathname(), $modelsPath.DIRECTORY_SEPARATOR)
                        );

                        if (class_exists($className) && is_subclass_of($className, Model::class)) {
                            $models[] = $className;
                        }
                    }
                }
            }
        }

        return $models;
    }

    /**
     * Find a model class by its short name.
     */
    private function findModelClass(string $shortName): ?string
    {
        $models = $this->discoverModels();

        foreach ($models as $modelClass) {
            if (class_basename($modelClass) === $shortName) {
                return $modelClass;
            }
        }

        return null;
    }

    /**
     * Get basic information about a model.
     *
     * @return array<string, mixed>
     */
    private function getModelBasicInfo(Model $model): array
    {
        return [
            'class' => get_class($model),
            'short_name' => class_basename($model),
            'table' => $model->getTable(),
            'connection' => $model->getConnectionName(),
            'primary_key' => $model->getKeyName(),
            'timestamps' => $model->usesTimestamps(),
        ];
    }

    /**
     * Get model attributes information.
     *
     * @return array<string, mixed>
     */
    private function getModelAttributes(Model $model): array
    {
        return [
            'fillable' => $model->getFillable(),
            'guarded' => $model->getGuarded(),
            'casts' => $this->getModelCasts($model),
            'hidden' => $model->getHidden(),
        ];
    }

    /**
     * Get model casts with their types.
     *
     * @return array<int, array{attribute: string, type: string}>
     */
    private function getModelCasts(Model $model): array
    {
        $casts = $model->getCasts();
        $formatted = [];

        foreach ($casts as $attribute => $cast) {
            $formatted[] = [
                'attribute' => $attribute,
                'type' => $cast,
            ];
        }

        return $formatted;
    }

    /**
     * Get model relationships.
     *
     * @return array<int, array{name: string, type: string, related_model: string}>
     */
    private function getModelRelationships(Model $model): array
    {
        $relationships = [];
        $reflectionClass = new ReflectionClass($model);

        foreach ($reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            // Skip inherited methods and non-relation methods
            if (
                $method->class !== get_class($model)
                || $method->getNumberOfParameters() > 0
                || $method->isStatic()
            ) {
                continue;
            }

            try {
                $return = $method->invoke($model);

                if ($return instanceof Relation) {
                    $relationships[] = [
                        'name' => $method->getName(),
                        'type' => class_basename(get_class($return)),
                        'related_model' => get_class($return->getRelated()),
                    ];
                }
            } catch (\Exception $e) {
                // Skip methods that throw exceptions
                continue;
            }
        }

        return $relationships;
    }

    /**
     * Get database table schema.
     *
     * @return array<string, mixed>
     */
    private function getTableSchema(Model $model): array
    {
        $table = $model->getTable();
        $connection = $model->getConnection();
        $schema = $connection->getSchemaBuilder();
        $columns = [];

        try {
            $columnListing = $schema->getColumns($table);

            foreach ($columnListing as $column) {
                $columns[] = [
                    'name' => $column['name'],
                    'type' => $column['type_name'],
                    'nullable' => $column['nullable'],
                    'default' => $column['default'],
                    'auto_increment' => $column['auto_increment'],
                ];
            }

            // Get indexes
            $indexes = $schema->getIndexes($table);
            $indexInfo = [];

            foreach ($indexes as $index) {
                $indexInfo[] = [
                    'name' => $index['name'],
                    'columns' => $index['columns'],
                    'type' => $index['primary'] ? 'primary' : ($index['unique'] ? 'unique' : 'index'),
                ];
            }

            return [
                'columns' => $columns,
                'indexes' => $indexInfo,
            ];
        } catch (\Exception $e) {
            return [
                'columns' => [],
                'indexes' => [],
                'error' => 'Failed to retrieve schema: '.$e->getMessage(),
            ];
        }
    }
}
