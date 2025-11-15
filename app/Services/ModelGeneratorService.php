<?php

namespace App\Services;

use Illuminate\Support\Str;

class ModelGeneratorService
{
    /**
     * Load a template file.
     */
    private function loadTemplate(string $name): string
    {
        $path = resource_path("templates/model-builder/{$name}.stub");
        
        if (! file_exists($path)) {
            throw new \Exception("Template file not found: {$path}");
        }
        
        return file_get_contents($path);
    }
    
    /**
     * Replace placeholders in template.
     */
    private function renderTemplate(string $template, array $data): string
    {
        foreach ($data as $key => $value) {
            $template = str_replace("{{ {$key} }}", $value, $template);
        }
        
        return $template;
    }
    
    /**
     * Generate model source code using template.
     */
    public function generateModelSource(string $modelName, array $attributes, bool $timestamps, bool $softDeletes, bool $hasStatuses): string
    {
        $fillable = [];
        $casts = [];
        $relations = [];

        foreach ($attributes as $attribute) {
            if (! empty($attribute['name'])) {
                $fillable[] = $attribute['name'];
            }

            // Add casts for specific types
            if (! empty($attribute['name']) && in_array($attribute['type'], ['boolean', 'integer', 'float', 'decimal', 'date', 'datetime', 'timestamp', 'json'])) {
                $castType = $attribute['type'];
                if ($castType === 'timestamp') {
                    $castType = 'datetime';
                }
                $casts[$attribute['name']] = $castType;
            }

            // Generate relationships
            if (isset($attribute['is_foreign_key']) && $attribute['is_foreign_key'] && ! empty($attribute['foreign_model'])) {
                $relations[] = $this->generateRelationMethod($attribute);
            }
        }

        $fillableStr = ! empty($fillable) ? "'".implode("',\n        '", $fillable)."'" : '';
        $castsStr = $this->formatCastsArray($casts);
        $relationsStr = implode("\n\n", $relations);

        $uses = ['use Illuminate\Database\Eloquent\Model'];
        $uses[] = 'use Illuminate\Database\Eloquent\Concerns\HasUlids';
        $uses[] = 'use Illuminate\Database\Eloquent\Factories\HasFactory';
        if (! empty($relations)) {
            $uses[] = 'use Illuminate\Database\Eloquent\Relations\BelongsTo';
            $uses[] = 'use Illuminate\Database\Eloquent\Relations\HasOne';
            $uses[] = 'use Illuminate\Database\Eloquent\Relations\HasMany';
            $uses[] = 'use Illuminate\Database\Eloquent\Relations\BelongsToMany';
        }
        if ($softDeletes) {
            $uses[] = 'use Illuminate\Database\Eloquent\SoftDeletes';
        }
        if ($hasStatuses) {
            $uses[] = 'use Spatie\ModelStatus\HasStatuses';
        }

        $usesStr = implode(";\n", $uses).';';
        $traits = ['HasFactory', 'HasUlids'];
        if ($softDeletes) {
            $traits[] = 'SoftDeletes';
        }
        if ($hasStatuses) {
            $traits[] = 'HasStatuses';
        }
        $traitsStr = 'use '.implode(', ', $traits).';';
        $timestampsProperty = ! $timestamps ? "\n    public \$timestamps = false;" : '';

        $template = $this->loadTemplate('model');
        
        return $this->renderTemplate($template, [
            'modelName' => $modelName,
            'uses' => $usesStr,
            'traits' => $traitsStr,
            'timestampsProperty' => $timestampsProperty,
            'fillable' => $fillableStr,
            'casts' => $castsStr,
            'relations' => $relationsStr,
        ]);
    }
    
    /**
     * Generate migration source code using template.
     */
    public function generateMigrationSource(string $modelName, array $attributes, bool $timestamps, bool $softDeletes): string
    {
        $tableName = Str::snake(Str::plural($modelName));

        $columns = [];
        foreach ($attributes as $attribute) {
            if (! empty($attribute['name'])) {
                $column = $this->generateColumnDefinition($attribute);
                $columns[] = $column;
            }
        }

        $columnsStr = implode("\n", $columns);
        $timestampsStr = $timestamps ? "\n            \$table->timestamps();" : '';
        $softDeletesStr = $softDeletes ? "\n            \$table->softDeletes();" : '';

        $template = $this->loadTemplate('migration');
        
        return $this->renderTemplate($template, [
            'tableName' => $tableName,
            'columns' => $columnsStr,
            'timestamps' => $timestampsStr,
            'softDeletes' => $softDeletesStr,
        ]);
    }
    
    /**
     * Generate factory source code using template.
     */
    public function generateFactorySource(string $modelName, array $attributes): string
    {
        $factoryName = $modelName.'Factory';
        $definitions = [];

        foreach ($attributes as $attribute) {
            if (empty($attribute['name'])) {
                continue;
            }

            $name = $attribute['name'];
            $type = $attribute['type'];

            $faker = match ($type) {
                'string' => 'fake()->sentence(3)',
                'text' => 'fake()->paragraph()',
                'integer' => 'fake()->numberBetween(1, 1000)',
                'bigInteger' => 'fake()->numberBetween(1, 1000000)',
                'float', 'decimal' => 'fake()->randomFloat(2, 0, 1000)',
                'boolean' => 'fake()->boolean()',
                'date' => 'fake()->date()',
                'datetime', 'timestamp' => 'fake()->dateTime()',
                'json' => "json_encode(['key' => fake()->word()])",
                default => 'fake()->word()',
            };

            $definitions[] = "            '{$name}' => {$faker}";
        }

        $definitionsStr = implode(",\n", $definitions);

        $template = $this->loadTemplate('factory');
        
        return $this->renderTemplate($template, [
            'modelName' => $modelName,
            'factoryName' => $factoryName,
            'definitions' => $definitionsStr,
        ]);
    }
    
    /**
     * Generate pivot migration source code using template.
     */
    public function generatePivotMigrationSource(string $modelName, string $foreignModel, string $pivotTableName): string
    {
        $modelColumn = Str::snake($modelName).'_id';
        $foreignColumn = Str::snake($foreignModel).'_id';
        $modelTable = Str::snake(Str::plural($modelName));
        $foreignTable = Str::snake(Str::plural($foreignModel));

        $template = $this->loadTemplate('pivot-migration');
        
        return $this->renderTemplate($template, [
            'pivotTableName' => $pivotTableName,
            'modelColumn' => $modelColumn,
            'foreignColumn' => $foreignColumn,
            'modelTable' => $modelTable,
            'foreignTable' => $foreignTable,
        ]);
    }
    
    /**
     * Generate column definition for migration.
     */
    public function generateColumnDefinition(array $attribute): string
    {
        $name = $attribute['name'];
        $type = $attribute['type'];
        $isForeignKey = $attribute['is_foreign_key'] ?? false;
        $nullable = $attribute['nullable'] ?? false;
        $indexType = $attribute['index_type'] ?? 'none';

        $column = "            ";

        if ($isForeignKey && ($attribute['relation_type'] ?? '') !== 'belongsToMany') {
            // Generate foreign key column with constraints
            $foreignModel = $attribute['foreign_model'] ?? '';
            $foreignTable = $foreignModel ? Str::snake(Str::plural($foreignModel)) : '';
            $onDelete = $attribute['on_delete'] ?? 'cascade';
            $onUpdate = $attribute['on_update'] ?? 'cascade';
            
            $column .= "\$table->foreignUlid('{$name}')";
            if ($nullable) {
                $column .= '->nullable()';
            }
            if ($foreignTable) {
                $column .= "->constrained('{$foreignTable}')";
                $column .= "->onDelete('{$onDelete}')";
                $column .= "->onUpdate('{$onUpdate}')";
            }
            $column .= ';';
        } else {
            switch ($type) {
                case 'string':
                    $column .= "\$table->string('{$name}')";
                    break;
                case 'text':
                    $column .= "\$table->text('{$name}')";
                    break;
                case 'integer':
                    $column .= "\$table->integer('{$name}')";
                    break;
                case 'bigInteger':
                    $column .= "\$table->bigInteger('{$name}')";
                    break;
                case 'float':
                    $column .= "\$table->float('{$name}')";
                    break;
                case 'decimal':
                    $column .= "\$table->decimal('{$name}', 8, 2)";
                    break;
                case 'boolean':
                    $column .= "\$table->boolean('{$name}')";
                    break;
                case 'date':
                    $column .= "\$table->date('{$name}')";
                    break;
                case 'datetime':
                    $column .= "\$table->dateTime('{$name}')";
                    break;
                case 'timestamp':
                    $column .= "\$table->timestamp('{$name}')";
                    break;
                case 'json':
                    $column .= "\$table->json('{$name}')";
                    break;
                case 'binary':
                    $column .= "\$table->binary('{$name}')";
                    break;
                default:
                    $column .= "\$table->string('{$name}')";
            }

            if ($nullable) {
                $column .= '->nullable()';
            }

            if ($indexType === 'index') {
                $column .= '->index()';
            } elseif ($indexType === 'unique') {
                $column .= '->unique()';
            }

            $column .= ';';
        }

        return $column;
    }
    
    /**
     * Generate relation method for model.
     */
    public function generateRelationMethod(array $attribute): string
    {
        $foreignModel = $attribute['foreign_model'];
        $relationType = $attribute['relation_type'] ?? 'belongsTo';
        $methodName = Str::camel($foreignModel);

        if ($relationType === 'hasMany' || $relationType === 'belongsToMany') {
            $methodName = Str::plural($methodName);
        }

        $relationClass = match ($relationType) {
            'belongsTo' => 'BelongsTo',
            'hasOne' => 'HasOne',
            'hasMany' => 'HasMany',
            'belongsToMany' => 'BelongsToMany',
            default => 'BelongsTo',
        };

        return <<<PHP
            public function {$methodName}(): {$relationClass}
            {
                return \$this->{$relationType}({$foreignModel}::class);
            }
        PHP;
    }
    
    /**
     * Format casts array for model.
     */
    public function formatCastsArray(array $casts): string
    {
        if (empty($casts)) {
            return '';
        }

        $castsFormatted = [];
        foreach ($casts as $field => $type) {
            $castsFormatted[] = "        '{$field}' => '{$type}'";
        }

        return "    protected \$casts = [\n".implode(",\n", $castsFormatted).",\n    ];";
    }
}
