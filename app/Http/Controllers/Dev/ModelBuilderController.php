<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModelBuilderController extends Controller
{
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
     * Generate model, migration, and factory based on form data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'model_name' => 'required|string|regex:/^[A-Z][a-zA-Z0-9]*$/',
            'timestamps' => 'boolean',
            'soft_deletes' => 'boolean',
            'generate_migration' => 'boolean',
            'generate_factory' => 'boolean',
            'attributes' => 'required|array|min:1',
            'attributes.*.name' => 'required|string|regex:/^[a-z_][a-z0-9_]*$/',
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
        $generateMigration = $validated['generate_migration'] ?? false;
        $generateFactory = $validated['generate_factory'] ?? false;

        try {
            // Generate Model
            $modelPath = $this->generateModel($modelName, $attributes, $timestamps, $softDeletes);

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
    private function generateModel(string $modelName, array $attributes, bool $timestamps, bool $softDeletes): string
    {
        $fillable = [];
        $casts = [];
        $relations = [];

        foreach ($attributes as $attribute) {
            $fillable[] = $attribute['name'];

            // Add casts for specific types
            if (in_array($attribute['type'], ['boolean', 'integer', 'float', 'decimal', 'date', 'datetime', 'timestamp', 'json'])) {
                $castType = $attribute['type'];
                if ($castType === 'timestamp') {
                    $castType = 'datetime';
                }
                $casts[$attribute['name']] = $castType;
            }

            // Generate relationships
            if (isset($attribute['is_foreign_key']) && $attribute['is_foreign_key'] && !empty($attribute['foreign_model'])) {
                $relations[] = $this->generateRelationMethod($attribute);
            }
        }

        $fillableStr = implode("',\n        '", $fillable);
        $castsStr = $this->formatCastsArray($casts);
        $relationsStr = implode("\n\n", $relations);

        $uses = ['use Illuminate\Database\Eloquent\Model'];
        if (!empty($relations)) {
            $uses[] = 'use Illuminate\Database\Eloquent\Relations\BelongsTo';
            $uses[] = 'use Illuminate\Database\Eloquent\Relations\HasOne';
            $uses[] = 'use Illuminate\Database\Eloquent\Relations\HasMany';
            $uses[] = 'use Illuminate\Database\Eloquent\Relations\BelongsToMany';
        }
        if ($softDeletes) {
            $uses[] = 'use Illuminate\Database\Eloquent\SoftDeletes';
        }

        $usesStr = implode(";\n", $uses) . ';';
        $traitsStr = $softDeletes ? 'use SoftDeletes;' : '';
        $timestampsStr = !$timestamps ? "\n    public \$timestamps = false;" : '';

        $content = <<<PHP
<?php

namespace App\Models;

{$usesStr}

class {$modelName} extends Model
{
    {$traitsStr}{$timestampsStr}

    protected \$fillable = [
        '{$fillableStr}',
    ];

{$castsStr}
{$relationsStr}
}
PHP;

        $modelPath = app_path("Models/{$modelName}.php");
        
        if (File::exists($modelPath)) {
            throw new \Exception("Model {$modelName} already exists");
        }

        File::put($modelPath, $content);

        return $modelPath;
    }

    /**
     * Generate a relationship method.
     */
    private function generateRelationMethod(array $attribute): string
    {
        $relationType = $attribute['relation_type'] ?? 'belongsTo';
        $foreignModel = $attribute['foreign_model'];
        $methodName = Str::camel($foreignModel);

        // Adjust method name for different relation types
        if ($relationType === 'hasMany' || $relationType === 'belongsToMany') {
            $methodName = Str::plural($methodName);
        }

        $relationClass = ucfirst($relationType);
        
        return <<<PHP
    public function {$methodName}(): {$relationClass}
    {
        return \$this->{$relationType}({$foreignModel}::class);
    }
PHP;
    }

    /**
     * Format the casts array.
     */
    private function formatCastsArray(array $casts): string
    {
        if (empty($casts)) {
            return '';
        }

        $lines = [];
        foreach ($casts as $key => $value) {
            $lines[] = "        '{$key}' => '{$value}'";
        }

        return "    protected \$casts = [\n" . implode(",\n", $lines) . ",\n    ];";
    }

    /**
     * Generate the migration file.
     */
    private function generateMigration(string $modelName, array $attributes, bool $timestamps, bool $softDeletes): string
    {
        $tableName = Str::snake(Str::plural($modelName));
        $className = 'Create' . Str::plural($modelName) . 'Table';
        
        $columns = [];
        $foreignKeys = [];

        foreach ($attributes as $attribute) {
            $column = $this->generateColumnDefinition($attribute);
            $columns[] = $column;

            // Handle foreign keys
            if (isset($attribute['is_foreign_key']) && $attribute['is_foreign_key'] && !empty($attribute['foreign_model'])) {
                $foreignKeys[] = $this->generateForeignKeyDefinition($attribute);
            }
        }

        $columnsStr = implode("\n", $columns);
        $timestampsStr = $timestamps ? "\n            \$table->timestamps();" : '';
        $softDeletesStr = $softDeletes ? "\n            \$table->softDeletes();" : '';
        $foreignKeysStr = !empty($foreignKeys) ? "\n\n" . implode("\n", $foreignKeys) : '';

        $content = <<<PHP
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('{$tableName}', function (Blueprint \$table) {
            \$table->id();
{$columnsStr}{$timestampsStr}{$softDeletesStr}
        });{$foreignKeysStr}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('{$tableName}');
    }
};
PHP;

        $timestamp = date('Y_m_d_His');
        $fileName = "{$timestamp}_create_{$tableName}_table.php";
        $migrationPath = database_path("migrations/{$fileName}");

        File::put($migrationPath, $content);

        return $migrationPath;
    }

    /**
     * Generate column definition for migration.
     */
    private function generateColumnDefinition(array $attribute): string
    {
        $name = $attribute['name'];
        $type = $attribute['type'];
        $nullable = $attribute['nullable'] ?? false;
        $indexType = $attribute['index_type'] ?? 'none';

        // Map types to Laravel Blueprint methods
        $typeMethod = match ($type) {
            'string' => "string('{$name}')",
            'text' => "text('{$name}')",
            'integer' => "integer('{$name}')",
            'bigInteger' => "bigInteger('{$name}')",
            'float' => "float('{$name}')",
            'decimal' => "decimal('{$name}', 8, 2)",
            'boolean' => "boolean('{$name}')",
            'date' => "date('{$name}')",
            'datetime' => "dateTime('{$name}')",
            'timestamp' => "timestamp('{$name}')",
            'json' => "json('{$name}')",
            'binary' => "binary('{$name}')",
            default => "string('{$name}')",
        };

        $definition = "            \$table->{$typeMethod}";

        if ($nullable) {
            $definition .= '->nullable()';
        }

        if ($indexType === 'index') {
            $definition .= '->index()';
        } elseif ($indexType === 'unique') {
            $definition .= '->unique()';
        }

        $definition .= ';';

        return $definition;
    }

    /**
     * Generate foreign key constraint definition.
     */
    private function generateForeignKeyDefinition(array $attribute): string
    {
        $columnName = $attribute['name'];
        $foreignModel = $attribute['foreign_model'];
        $foreignTable = Str::snake(Str::plural($foreignModel));
        $onDelete = $attribute['on_delete'] ?? 'cascade';
        $onUpdate = $attribute['on_update'] ?? 'cascade';

        // Convert "set null" to "setNull" for Laravel
        $onDeleteMethod = str_replace(' ', '', ucwords($onDelete));
        $onDeleteMethod = lcfirst($onDeleteMethod);
        $onUpdateMethod = str_replace(' ', '', ucwords($onUpdate));
        $onUpdateMethod = lcfirst($onUpdateMethod);

        return <<<PHP
        Schema::table('{$this->getTableNameForMigration($attribute)}', function (Blueprint \$table) {
            \$table->foreign('{$columnName}')->references('id')->on('{$foreignTable}')->onDelete('{$onDeleteMethod}')->onUpdate('{$onUpdateMethod}');
        });
PHP;
    }

    /**
     * Get table name from context (hacky but works for this use case).
     */
    private function getTableNameForMigration(array $attribute): string
    {
        // This would be set during migration generation
        return $this->currentTableName ?? 'table';
    }

    /**
     * Generate the factory file.
     */
    private function generateFactory(string $modelName, array $attributes): string
    {
        $factoryName = $modelName . 'Factory';
        $definitions = [];

        foreach ($attributes as $attribute) {
            $name = $attribute['name'];
            $type = $attribute['type'];

            $faker = match ($type) {
                'string' => "fake()->sentence(3)",
                'text' => "fake()->paragraph()",
                'integer' => "fake()->numberBetween(1, 1000)",
                'bigInteger' => "fake()->numberBetween(1, 1000000)",
                'float', 'decimal' => "fake()->randomFloat(2, 0, 1000)",
                'boolean' => "fake()->boolean()",
                'date' => "fake()->date()",
                'datetime', 'timestamp' => "fake()->dateTime()",
                'json' => "json_encode(['key' => fake()->word()])",
                default => "fake()->word()",
            };

            $definitions[] = "            '{$name}' => {$faker}";
        }

        $definitionsStr = implode(",\n", $definitions);

        $content = <<<PHP
<?php

namespace Database\Factories;

use App\Models\\{$modelName};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\\{$modelName}>
 */
class {$factoryName} extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
{$definitionsStr},
        ];
    }
}
PHP;

        $factoryPath = database_path("factories/{$factoryName}.php");

        if (File::exists($factoryPath)) {
            throw new \Exception("Factory {$factoryName} already exists");
        }

        File::put($factoryPath, $content);

        return $factoryPath;
    }

    /**
     * Get available models in app/Models directory.
     */
    private function getAvailableModels(): array
    {
        $modelsPath = app_path('Models');
        $models = [];

        if (!File::isDirectory($modelsPath)) {
            return $models;
        }

        $files = File::allFiles($modelsPath);

        foreach ($files as $file) {
            $className = str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($file->getPathname(), $modelsPath . DIRECTORY_SEPARATOR)
            );

            $models[] = $className;
        }

        return $models;
    }
}
