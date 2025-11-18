<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SchemaMermaidGenerator
{
    /**
     * Tables to ignore by default
     */
    protected array $ignoredTables = [
        'migrations',
        'failed_jobs',
        'password_reset_tokens',
        'personal_access_tokens',
        'cache',
        'cache_locks',
        'sessions',
        'job_batches',
        'jobs',
    ];

    /**
     * Constructor
     */
    public function __construct(array $ignoredTables = [])
    {
        if (!empty($ignoredTables)) {
            $this->ignoredTables = $ignoredTables;
        }
    }

    /**
     * Generate Mermaid ER diagram from database schema
     */
    public function generate(): string
    {
        $tables = $this->getTables();
        $foreignKeys = $this->getForeignKeys();
        
        $mermaid = "erDiagram\n";
        
        // Generate table definitions
        foreach ($tables as $tableName) {
            if ($this->shouldIgnoreTable($tableName)) {
                continue;
            }
            
            $mermaid .= $this->generateTableDefinition($tableName);
        }
        
        // Generate relationships
        $mermaid .= $this->generateRelationships($foreignKeys);
        
        return $mermaid;
    }

    /**
     * Get all tables from the database
     */
    protected function getTables(): array
    {
        $connection = Schema::getConnection();
        $driverName = $connection->getDriverName();
        
        switch ($driverName) {
            case 'mysql':
                return $this->getMySQLTables();
            case 'pgsql':
                return $this->getPostgreSQLTables();
            case 'sqlite':
                return $this->getSQLiteTables();
            default:
                throw new \Exception("Unsupported database driver: {$driverName}");
        }
    }

    /**
     * Get tables for MySQL
     */
    protected function getMySQLTables(): array
    {
        $database = DB::getDatabaseName();
        $tables = DB::select("
            SELECT TABLE_NAME 
            FROM INFORMATION_SCHEMA.TABLES 
            WHERE TABLE_SCHEMA = ? 
            AND TABLE_TYPE = 'BASE TABLE'
            ORDER BY TABLE_NAME
        ", [$database]);
        
        return array_map(fn($table) => $table->TABLE_NAME, $tables);
    }

    /**
     * Get tables for PostgreSQL
     */
    protected function getPostgreSQLTables(): array
    {
        $tables = DB::select("
            SELECT tablename 
            FROM pg_catalog.pg_tables 
            WHERE schemaname = 'public'
            ORDER BY tablename
        ");
        
        return array_map(fn($table) => $table->tablename, $tables);
    }

    /**
     * Get tables for SQLite
     */
    protected function getSQLiteTables(): array
    {
        $tables = DB::select("
            SELECT name 
            FROM sqlite_master 
            WHERE type = 'table' 
            AND name NOT LIKE 'sqlite_%'
            ORDER BY name
        ");
        
        return array_map(fn($table) => $table->name, $tables);
    }

    /**
     * Check if table should be ignored
     */
    protected function shouldIgnoreTable(string $tableName): bool
    {
        return in_array($tableName, $this->ignoredTables);
    }

    /**
     * Generate Mermaid definition for a table
     */
    protected function generateTableDefinition(string $tableName): string
    {
        $columns = $this->getTableColumns($tableName);
        $indexes = $this->getTableIndexes($tableName);
        
        $definition = "    " . strtoupper($tableName) . " {\n";
        
        foreach ($columns as $column) {
            $type = $this->simplifyColumnType($column['type']);
            $constraints = [];
            
            // Check if column is primary key (from column info or indexes)
            if (isset($column['is_primary']) && $column['is_primary']) {
                $constraints[] = 'PK';
            } elseif ($this->isPrimaryKey($column['name'], $indexes)) {
                $constraints[] = 'PK';
            }
            
            if ($this->isUniqueKey($column['name'], $indexes)) {
                $constraints[] = 'UK';
            }
            
            if ($this->isForeignKey($tableName, $column['name'])) {
                $constraints[] = 'FK';
            }
            
            $constraintStr = !empty($constraints) ? ' ' . implode(',', $constraints) : '';
            $nullable = $column['nullable'] ? '' : '';
            
            $definition .= "        {$type} {$column['name']}{$constraintStr}\n";
        }
        
        $definition .= "    }\n";
        
        return $definition;
    }

    /**
     * Get columns for a table
     */
    protected function getTableColumns(string $tableName): array
    {
        $connection = Schema::getConnection();
        $driverName = $connection->getDriverName();
        
        switch ($driverName) {
            case 'mysql':
                return $this->getMySQLColumns($tableName);
            case 'pgsql':
                return $this->getPostgreSQLColumns($tableName);
            case 'sqlite':
                return $this->getSQLiteColumns($tableName);
            default:
                return [];
        }
    }

    /**
     * Get columns for MySQL table
     */
    protected function getMySQLColumns(string $tableName): array
    {
        $database = DB::getDatabaseName();
        $columns = DB::select("
            SELECT 
                COLUMN_NAME as name,
                COLUMN_TYPE as type,
                IS_NULLABLE as nullable,
                COLUMN_DEFAULT as default_value,
                COLUMN_KEY as key_type
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = ? 
            AND TABLE_NAME = ?
            ORDER BY ORDINAL_POSITION
        ", [$database, $tableName]);
        
        return array_map(function ($column) {
            return [
                'name' => $column->name,
                'type' => $column->type,
                'nullable' => $column->nullable === 'YES',
                'default' => $column->default_value,
                'is_primary' => $column->key_type === 'PRI',
            ];
        }, $columns);
    }

    /**
     * Get columns for PostgreSQL table
     */
    protected function getPostgreSQLColumns(string $tableName): array
    {
        $columns = DB::select("
            SELECT 
                c.column_name as name,
                c.data_type as type,
                c.is_nullable as nullable,
                c.column_default as default_value,
                CASE WHEN pk.column_name IS NOT NULL THEN true ELSE false END as is_primary
            FROM information_schema.columns c
            LEFT JOIN (
                SELECT ku.column_name
                FROM information_schema.table_constraints tc
                JOIN information_schema.key_column_usage ku
                    ON tc.constraint_name = ku.constraint_name
                WHERE tc.constraint_type = 'PRIMARY KEY'
                    AND ku.table_name = ?
            ) pk ON c.column_name = pk.column_name
            WHERE c.table_name = ?
            ORDER BY c.ordinal_position
        ", [$tableName, $tableName]);
        
        return array_map(function ($column) {
            return [
                'name' => $column->name,
                'type' => $column->type,
                'nullable' => $column->nullable === 'YES',
                'default' => $column->default_value,
                'is_primary' => $column->is_primary ?? false,
            ];
        }, $columns);
    }

    /**
     * Get columns for SQLite table
     */
    protected function getSQLiteColumns(string $tableName): array
    {
        $columns = DB::select("PRAGMA table_info({$tableName})");
        
        return array_map(function ($column) {
            return [
                'name' => $column->name,
                'type' => $column->type,
                'nullable' => $column->notnull == 0,
                'default' => $column->dflt_value,
                'is_primary' => $column->pk > 0,
            ];
        }, $columns);
    }

    /**
     * Get indexes for a table
     */
    protected function getTableIndexes(string $tableName): array
    {
        $connection = Schema::getConnection();
        $driverName = $connection->getDriverName();
        
        switch ($driverName) {
            case 'mysql':
                return $this->getMySQLIndexes($tableName);
            case 'pgsql':
                return $this->getPostgreSQLIndexes($tableName);
            case 'sqlite':
                return $this->getSQLiteIndexes($tableName);
            default:
                return [];
        }
    }

    /**
     * Get indexes for MySQL table
     */
    protected function getMySQLIndexes(string $tableName): array
    {
        $database = DB::getDatabaseName();
        $indexes = DB::select("
            SELECT 
                INDEX_NAME as name,
                COLUMN_NAME as column_name,
                NON_UNIQUE as non_unique
            FROM INFORMATION_SCHEMA.STATISTICS 
            WHERE TABLE_SCHEMA = ? 
            AND TABLE_NAME = ?
            ORDER BY INDEX_NAME, SEQ_IN_INDEX
        ", [$database, $tableName]);
        
        $result = [];
        foreach ($indexes as $index) {
            $name = $index->name;
            if (!isset($result[$name])) {
                $result[$name] = [
                    'name' => $name,
                    'unique' => $index->non_unique == 0,
                    'columns' => [],
                ];
            }
            $result[$name]['columns'][] = $index->column_name;
        }
        
        return array_values($result);
    }

    /**
     * Get indexes for PostgreSQL table
     */
    protected function getPostgreSQLIndexes(string $tableName): array
    {
        $indexes = DB::select("
            SELECT
                i.relname as name,
                a.attname as column_name,
                ix.indisunique as is_unique
            FROM pg_class t
            JOIN pg_index ix ON t.oid = ix.indrelid
            JOIN pg_class i ON i.oid = ix.indexrelid
            JOIN pg_attribute a ON a.attrelid = t.oid AND a.attnum = ANY(ix.indkey)
            WHERE t.relname = ?
            ORDER BY i.relname
        ", [$tableName]);
        
        $result = [];
        foreach ($indexes as $index) {
            $name = $index->name;
            if (!isset($result[$name])) {
                $result[$name] = [
                    'name' => $name,
                    'unique' => $index->is_unique,
                    'columns' => [],
                ];
            }
            $result[$name]['columns'][] = $index->column_name;
        }
        
        return array_values($result);
    }

    /**
     * Get indexes for SQLite table
     */
    protected function getSQLiteIndexes(string $tableName): array
    {
        $indexes = DB::select("PRAGMA index_list({$tableName})");
        
        $result = [];
        foreach ($indexes as $index) {
            $indexInfo = DB::select("PRAGMA index_info({$index->name})");
            $columns = array_map(fn($info) => $info->name, $indexInfo);
            
            $result[] = [
                'name' => $index->name,
                'unique' => $index->unique == 1,
                'columns' => $columns,
            ];
        }
        
        return $result;
    }

    /**
     * Check if column is primary key
     */
    protected function isPrimaryKey(string $columnName, array $indexes): bool
    {
        foreach ($indexes as $index) {
            if (strtoupper($index['name']) === 'PRIMARY' && in_array($columnName, $index['columns'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if column is unique key
     */
    protected function isUniqueKey(string $columnName, array $indexes): bool
    {
        foreach ($indexes as $index) {
            if ($index['unique'] && strtoupper($index['name']) !== 'PRIMARY' && in_array($columnName, $index['columns'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if column is foreign key
     */
    protected function isForeignKey(string $tableName, string $columnName): bool
    {
        $foreignKeys = $this->getForeignKeys();
        
        foreach ($foreignKeys as $fk) {
            if ($fk['table'] === $tableName && $fk['column'] === $columnName) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Get all foreign keys from the database
     */
    protected function getForeignKeys(): array
    {
        $connection = Schema::getConnection();
        $driverName = $connection->getDriverName();
        
        switch ($driverName) {
            case 'mysql':
                return $this->getMySQLForeignKeys();
            case 'pgsql':
                return $this->getPostgreSQLForeignKeys();
            case 'sqlite':
                return $this->getSQLiteForeignKeys();
            default:
                return [];
        }
    }

    /**
     * Get foreign keys for MySQL
     */
    protected function getMySQLForeignKeys(): array
    {
        $database = DB::getDatabaseName();
        $foreignKeys = DB::select("
            SELECT 
                TABLE_NAME as table_name,
                COLUMN_NAME as column_name,
                REFERENCED_TABLE_NAME as referenced_table,
                REFERENCED_COLUMN_NAME as referenced_column
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = ? 
            AND REFERENCED_TABLE_NAME IS NOT NULL
            ORDER BY TABLE_NAME, COLUMN_NAME
        ", [$database]);
        
        return array_map(function ($fk) {
            return [
                'table' => $fk->table_name,
                'column' => $fk->column_name,
                'referenced_table' => $fk->referenced_table,
                'referenced_column' => $fk->referenced_column,
            ];
        }, $foreignKeys);
    }

    /**
     * Get foreign keys for PostgreSQL
     */
    protected function getPostgreSQLForeignKeys(): array
    {
        $foreignKeys = DB::select("
            SELECT
                tc.table_name,
                kcu.column_name,
                ccu.table_name AS referenced_table,
                ccu.column_name AS referenced_column
            FROM information_schema.table_constraints AS tc
            JOIN information_schema.key_column_usage AS kcu
                ON tc.constraint_name = kcu.constraint_name
            JOIN information_schema.constraint_column_usage AS ccu
                ON ccu.constraint_name = tc.constraint_name
            WHERE tc.constraint_type = 'FOREIGN KEY'
            ORDER BY tc.table_name, kcu.column_name
        ");
        
        return array_map(function ($fk) {
            return [
                'table' => $fk->table_name,
                'column' => $fk->column_name,
                'referenced_table' => $fk->referenced_table,
                'referenced_column' => $fk->referenced_column,
            ];
        }, $foreignKeys);
    }

    /**
     * Get foreign keys for SQLite
     */
    protected function getSQLiteForeignKeys(): array
    {
        $tables = $this->getSQLiteTables();
        $foreignKeys = [];
        
        foreach ($tables as $table) {
            if ($this->shouldIgnoreTable($table)) {
                continue;
            }
            
            $tableForeignKeys = DB::select("PRAGMA foreign_key_list({$table})");
            
            foreach ($tableForeignKeys as $fk) {
                $foreignKeys[] = [
                    'table' => $table,
                    'column' => $fk->from,
                    'referenced_table' => $fk->table,
                    'referenced_column' => $fk->to,
                ];
            }
        }
        
        return $foreignKeys;
    }

    /**
     * Generate Mermaid relationships from foreign keys
     */
    protected function generateRelationships(array $foreignKeys): string
    {
        $relationships = '';
        $processedRelationships = [];
        
        foreach ($foreignKeys as $fk) {
            if ($this->shouldIgnoreTable($fk['table']) || $this->shouldIgnoreTable($fk['referenced_table'])) {
                continue;
            }
            
            $relationshipKey = $fk['table'] . '_' . $fk['referenced_table'];
            
            // Avoid duplicate relationships
            if (in_array($relationshipKey, $processedRelationships)) {
                continue;
            }
            
            $processedRelationships[] = $relationshipKey;
            
            $fromTable = strtoupper($fk['referenced_table']);
            $toTable = strtoupper($fk['table']);
            
            // One-to-many relationship with cardinality notation
            // ||--o{ means: one (parent) to zero or more (children)
            // (1,1) on parent side: one instance exists
            // (0,n) on child side: zero or more instances can reference the parent
            $relationships .= "    {$fromTable} ||--o{ {$toTable} : \"(1,1)-(0,n)\"\n";
        }
        
        return $relationships;
    }

    /**
     * Simplify column type for Mermaid display
     */
    protected function simplifyColumnType(string $type): string
    {
        // Extract base type from full type definition
        $type = strtolower($type);
        
        if (str_contains($type, 'int')) {
            return 'int';
        }
        if (str_contains($type, 'varchar') || str_contains($type, 'character varying')) {
            return 'varchar';
        }
        if (str_contains($type, 'text')) {
            return 'text';
        }
        if (str_contains($type, 'decimal') || str_contains($type, 'numeric')) {
            return 'decimal';
        }
        if (str_contains($type, 'timestamp') || str_contains($type, 'datetime')) {
            return 'timestamp';
        }
        if (str_contains($type, 'date')) {
            return 'date';
        }
        if (str_contains($type, 'bool')) {
            return 'boolean';
        }
        if (str_contains($type, 'json')) {
            return 'json';
        }
        
        return 'string';
    }
}
