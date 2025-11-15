<?php

namespace App\Http\Controllers\Dev;

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

        if (! $modelClass) {
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
     * Discover all Eloquent models in the app/Models directory.
     */
    private function discoverModels(): array
    {
        $modelsPath = app_path('Models');
        $models = [];

        if (! File::isDirectory($modelsPath)) {
            return $models;
        }

        $files = File::allFiles($modelsPath);

        foreach ($files as $file) {
            $className = 'App\\Models\\'.str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($file->getPathname(), $modelsPath.DIRECTORY_SEPARATOR)
            );

            if (class_exists($className) && is_subclass_of($className, Model::class)) {
                $models[] = $className;
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
                    'type' => $column['type_name'] ?? $column['type'],
                    'nullable' => $column['nullable'],
                    'default' => $column['default'],
                    'auto_increment' => $column['auto_increment'] ?? false,
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
