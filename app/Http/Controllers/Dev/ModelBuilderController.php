<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Services\ModelGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModelBuilderController extends Controller
{
    public function __construct(
        private ModelGeneratorService $generator
    ) {
    }
    /**
     * Show the model builder page.
     */
    public function show()
    {
        $models = $this->getAvailableModels();

        return view('dev.model-builder.index', [
            'models' => $models,
        ]);
    }

    /**
     * Preview what will be generated before actual generation.
     */
    public function preview(Request $request)
    {
        $validated = $request->validate([
            'model_name' => 'required|string|regex:/^[A-Z][a-zA-Z0-9]*$/',
            'timestamps' => 'boolean',
            'soft_deletes' => 'boolean',
            'has_statuses' => 'boolean',
            'generate_migration' => 'boolean',
            'generate_factory' => 'boolean',
            'attributes' => 'required|array|min:1',
            'attributes.*.name' => 'nullable|string|regex:/^[a-z_][a-z0-9_]*$/',
            'attributes.*.type' => 'required|string',
            'attributes.*.is_foreign_key' => 'boolean',
            'attributes.*.foreign_model' => 'nullable|string',
            'attributes.*.relation_type' => 'nullable|string',
            'attributes.*.nullable' => 'boolean',
            'attributes.*.index_type' => 'nullable|string',
            'attributes.*.on_delete' => 'nullable|string',
            'attributes.*.on_update' => 'nullable|string',
        ]);

        $modelName = $validated['model_name'];
        $attributes = $validated['attributes'];
        $timestamps = $validated['timestamps'] ?? true;
        $softDeletes = $validated['soft_deletes'] ?? false;
        $hasStatuses = $validated['has_statuses'] ?? false;
        $generateMigration = $validated['generate_migration'] ?? false;
        $generateFactory = $validated['generate_factory'] ?? false;

        $operations = [];

        // Generate model source code preview
        $modelSource = $this->generator->generateModelSource($modelName, $attributes, $timestamps, $softDeletes, $hasStatuses);
        $operations[] = [
            'type' => 'model',
            'description' => "Model: {$modelName}",
            'path' => "app/Models/{$modelName}.php",
            'traits' => $this->getModelTraits($validated),
            'source' => $modelSource,
        ];

        // Migration generation
        if ($generateMigration) {
            $tableName = Str::snake(Str::plural($modelName));
            $migrationSource = $this->generator->generateMigrationSource($modelName, $attributes, $timestamps, $softDeletes);
            $operations[] = [
                'type' => 'migration',
                'description' => "Migration: create_{$tableName}_table",
                'path' => "database/migrations/YYYY_MM_DD_HHMMSS_create_{$tableName}_table.php",
                'source' => $migrationSource,
            ];

            // Check for pivot tables
            foreach ($attributes as $attribute) {
                if (isset($attribute['is_foreign_key']) &&
                    $attribute['is_foreign_key'] &&
                    ! empty($attribute['foreign_model']) &&
                    ($attribute['relation_type'] ?? '') === 'belongsToMany') {

                    $foreignModel = $attribute['foreign_model'];
                    $tables = [Str::snake($modelName), Str::snake($foreignModel)];
                    sort($tables);
                    $pivotTableName = implode('_', $tables);

                    $pivotSource = $this->generator->generatePivotMigrationSource($modelName, $foreignModel, $pivotTableName);
                    $operations[] = [
                        'type' => 'pivot_migration',
                        'description' => "Pivot: {$pivotTableName}",
                        'path' => "database/migrations/YYYY_MM_DD_HHMMSS_create_{$pivotTableName}_table.php",
                        'note' => "For {$modelName} ↔ {$foreignModel} many-to-many relationship",
                        'source' => $pivotSource,
                    ];
                }
            }
        }

        // Factory generation
        if ($generateFactory) {
            $factorySource = $this->generator->generateFactorySource($modelName, $attributes);
            $operations[] = [
                'type' => 'factory',
                'description' => "Factory: {$modelName}Factory",
                'path' => "database/factories/{$modelName}Factory.php",
                'source' => $factorySource,
            ];
        }

        return response()->json([
            'operations' => $operations,
            'summary' => [
                'model' => $modelName,
                'files_count' => count($operations),
                'has_pivot_tables' => collect($operations)->where('type', 'pivot_migration')->isNotEmpty(),
            ],
        ]);
    }

    /**
     * Get traits that will be added to the model.
     */
    private function getModelTraits(array $validated): array
    {
        $traits = ['HasUlids'];

        if ($validated['soft_deletes'] ?? false) {
            $traits[] = 'SoftDeletes';
        }

        if ($validated['has_statuses'] ?? false) {
            $traits[] = 'HasStatuses (Spatie)';
        }

        return $traits;
    }

    /**
     * Generate model, migration, and factory based on form data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'model_name' => 'required|string|regex:/^[A-Z][a-zA-Z0-9]*$/',
            'timestamps' => 'boolean',
            'soft_deletes' => 'boolean',
            'has_statuses' => 'boolean',
            'generate_migration' => 'boolean',
            'generate_factory' => 'boolean',
            'attributes' => 'required|array|min:1',
            'attributes.*.name' => 'nullable|string|regex:/^[a-z_][a-z0-9_]*$/',
            'attributes.*.type' => 'required|string|in:string,text,integer,bigInteger,float,decimal,boolean,date,datetime,timestamp,json,binary',
            'attributes.*.nullable' => 'boolean',
            'attributes.*.index_type' => 'nullable|string|in:none,index,unique',
            'attributes.*.is_foreign_key' => 'boolean',
            'attributes.*.foreign_model' => 'nullable|string',
            'attributes.*.relation_type' => 'nullable|string|in:belongsTo,hasOne,hasMany,belongsToMany',
            'attributes.*.on_delete' => 'nullable|string|in:cascade,restrict,set null,no action',
            'attributes.*.on_update' => 'nullable|string|in:cascade,restrict,set null,no action',
        ]);

        $modelName = $validated['model_name'];
        $attributes = $validated['attributes'];
        $timestamps = $validated['timestamps'] ?? true;
        $softDeletes = $validated['soft_deletes'] ?? false;
        $hasStatuses = $validated['has_statuses'] ?? false;
        $generateMigration = $validated['generate_migration'] ?? false;
        $generateFactory = $validated['generate_factory'] ?? false;

        try {
            // Generate Model
            $modelPath = $this->generateModel($modelName, $attributes, $timestamps, $softDeletes, $hasStatuses);

            $response = [
                'success' => true,
                'message' => 'Model generated successfully',
                'files' => [
                    'model' => $modelPath,
                ],
            ];

            // Generate Migration if requested
            if ($generateMigration) {
                $migrationPath = $this->generateMigration($modelName, $attributes, $timestamps, $softDeletes);
                $response['files']['migration'] = $migrationPath;

                // Generate pivot tables for belongsToMany relationships
                $pivotMigrations = $this->generatePivotMigrations($modelName, $attributes);
                if (! empty($pivotMigrations)) {
                    $response['files']['pivot_migrations'] = $pivotMigrations;
                }
            }

            // Generate Factory if requested
            if ($generateFactory) {
                $factoryPath = $this->generateFactory($modelName, $attributes);
                $response['files']['factory'] = $factoryPath;
            }

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Generate the model file.
     */
    private function generateModel(string $modelName, array $attributes, bool $timestamps, bool $softDeletes, bool $hasStatuses = false): string
    {
        $modelSource = $this->generator->generateModelSource($modelName, $attributes, $timestamps, $softDeletes, $hasStatuses);
        
        $modelPath = app_path("Models/{$modelName}.php");
        File::ensureDirectoryExists(dirname($modelPath));
        File::put($modelPath, $modelSource);

        return $modelPath;
    }

    /**
     * Generate the migration file.
     */
    private function generateMigration(string $modelName, array $attributes, bool $timestamps, bool $softDeletes): string
    {
        $migrationSource = $this->generator->generateMigrationSource($modelName, $attributes, $timestamps, $softDeletes);
        
        $tableName = Str::snake(Str::plural($modelName));
        $timestamp = date('Y_m_d_His');
        $migrationName = "{$timestamp}_create_{$tableName}_table.php";
        $migrationPath = database_path("migrations/{$migrationName}");

        File::ensureDirectoryExists(dirname($migrationPath));
        File::put($migrationPath, $migrationSource);

        return $migrationPath;
    }

    /**
     * Generate the factory file.
     */
    private function generateFactory(string $modelName, array $attributes): string
    {
        $factorySource = $this->generator->generateFactorySource($modelName, $attributes);
        
        $factoryName = $modelName.'Factory';
        $factoryPath = database_path("factories/{$factoryName}.php");

        File::ensureDirectoryExists(dirname($factoryPath));
        File::put($factoryPath, $factorySource);

        return $factoryPath;
    }

    /**
     * Generate pivot table migrations for belongsToMany relationships.
     */
    private function generatePivotMigrations(string $modelName, array $attributes): array
    {
        $pivotMigrations = [];

        foreach ($attributes as $attribute) {
            if (isset($attribute['is_foreign_key']) &&
                $attribute['is_foreign_key'] &&
                ! empty($attribute['foreign_model']) &&
                ($attribute['relation_type'] ?? '') === 'belongsToMany') {

                $foreignModel = $attribute['foreign_model'];

                // Create pivot table name (alphabetically ordered)
                $tables = [Str::snake($modelName), Str::snake($foreignModel)];
                sort($tables);
                $pivotTableName = implode('_', $tables);

                // Generate pivot migration
                $pivotMigrationPath = $this->generatePivotMigration($modelName, $foreignModel, $pivotTableName);
                $pivotMigrations[] = $pivotMigrationPath;
            }
        }

        return $pivotMigrations;
    }

    /**
     * Generate a pivot table migration.
     */
    private function generatePivotMigration(string $modelName, string $foreignModel, string $pivotTableName): string
    {
        $pivotSource = $this->generator->generatePivotMigrationSource($modelName, $foreignModel, $pivotTableName);
        
        $timestamp = date('Y_m_d_His');
        usleep(10000); // Small delay to ensure unique timestamps
        $fileName = "{$timestamp}_create_{$pivotTableName}_table.php";
        $migrationPath = database_path("migrations/{$fileName}");

        File::ensureDirectoryExists(dirname($migrationPath));
        File::put($migrationPath, $pivotSource);

        return $migrationPath;
    }

    /**
     * Get available models in app/Models directory.
     */
    private function getAvailableModels(): array
    {
        $modelsPath = app_path('Models');
        $models = [];

        if (! File::isDirectory($modelsPath)) {
            return $models;
        }

        $files = File::allFiles($modelsPath);

        foreach ($files as $file) {
            $className = str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($file->getPathname(), $modelsPath.DIRECTORY_SEPARATOR)
            );

            $models[] = $className;
        }

        return $models;
    }
}
