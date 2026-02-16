<?php

namespace Tests\Unit\Support;

use App\Support\DevTools\Services\SchemaMermaidGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchemaMermaidGeneratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the generator can be instantiated
     */
    public function test_generator_can_be_instantiated(): void
    {
        $generator = new SchemaMermaidGenerator;
        static::assertInstanceOf(SchemaMermaidGenerator::class, $generator);
    }

    /**
     * Test that the generator produces valid Mermaid syntax
     */
    public function test_generator_produces_valid_mermaid_syntax(): void
    {
        $generator = new SchemaMermaidGenerator;
        $mermaid = $generator->generate();

        // Check that output starts with erDiagram
        static::assertStringStartsWith('erDiagram', $mermaid);

        // Check that output is not empty
        static::assertNotEmpty($mermaid);
    }

    /**
     * Test that the generator includes table definitions
     */
    public function test_generator_includes_table_definitions(): void
    {
        $generator = new SchemaMermaidGenerator;
        $mermaid = $generator->generate();

        // Should include USERS table (from migrations)
        static::assertStringContainsString('USERS', $mermaid);

        // Should include TASKS table (from migrations)
        static::assertStringContainsString('TASKS', $mermaid);
    }

    /**
     * Test that the generator excludes ignored tables
     */
    public function test_generator_excludes_ignored_tables(): void
    {
        $generator = new SchemaMermaidGenerator;
        $mermaid = $generator->generate();

        // Should NOT include migrations table
        static::assertStringNotContainsString('MIGRATIONS', $mermaid);

        // Should NOT include cache table
        static::assertStringNotContainsString('CACHE {', $mermaid);

        // Should NOT include jobs table
        static::assertStringNotContainsString('JOBS {', $mermaid);
    }

    /**
     * Test that the generator includes column definitions
     */
    public function test_generator_includes_column_definitions(): void
    {
        $generator = new SchemaMermaidGenerator;
        $mermaid = $generator->generate();

        // Should include common column names
        static::assertStringContainsString('id', $mermaid);
        static::assertStringContainsString('email', $mermaid);
        static::assertStringContainsString('name', $mermaid);
    }

    /**
     * Test that the generator marks primary keys
     */
    public function test_generator_marks_primary_keys(): void
    {
        $generator = new SchemaMermaidGenerator;
        $mermaid = $generator->generate();

        // Should mark primary keys with PK
        static::assertStringContainsString('PK', $mermaid);
    }

    /**
     * Test that the generator marks foreign keys
     */
    public function test_generator_marks_foreign_keys(): void
    {
        $generator = new SchemaMermaidGenerator;
        $mermaid = $generator->generate();

        // Should mark foreign keys with FK
        static::assertStringContainsString('FK', $mermaid);

        // Should include user_id foreign key from tasks table
        static::assertStringContainsString('user_id', $mermaid);
    }

    /**
     * Test that the generator includes relationships
     */
    public function test_generator_includes_relationships(): void
    {
        $generator = new SchemaMermaidGenerator;
        $mermaid = $generator->generate();

        // Should include relationship syntax
        static::assertStringContainsString('||--o{', $mermaid);

        // Should include cardinality notation
        static::assertStringContainsString('(1,1)-(0,n)', $mermaid);
    }

    /**
     * Test that the generator includes users-tasks relationship
     */
    public function test_generator_includes_users_tasks_relationship(): void
    {
        $generator = new SchemaMermaidGenerator;
        $mermaid = $generator->generate();

        // Should show that USERS has many TASKS
        static::assertStringContainsString('USERS ||--o{ TASKS', $mermaid);
    }

    /**
     * Test custom ignored tables
     */
    public function test_custom_ignored_tables(): void
    {
        // Create generator with custom ignored tables list
        $generator = new SchemaMermaidGenerator(['migrations', 'users', 'cache', 'jobs']);
        $mermaid = $generator->generate();

        // Should NOT include users table since it's in the ignored list
        static::assertStringNotContainsString('USERS {', $mermaid);

        // Should still include tasks table
        static::assertStringContainsString('TASKS', $mermaid);
    }

    /**
     * Test that generator handles database with no foreign keys gracefully
     */
    public function test_generator_handles_no_foreign_keys(): void
    {
        // Use a custom ignored list that excludes all tables with FKs
        $generator = new SchemaMermaidGenerator(['migrations', 'cache', 'jobs', 'tasks', 'statuses']);
        $mermaid = $generator->generate();

        // Should still generate valid Mermaid even without relationships
        static::assertStringStartsWith('erDiagram', $mermaid);

        // Should include at least the users table
        static::assertStringContainsString('USERS', $mermaid);
    }

    /**
     * Test that the generator simplifies column types correctly
     */
    public function test_generator_simplifies_column_types(): void
    {
        $generator = new SchemaMermaidGenerator;
        $mermaid = $generator->generate();

        // Should use simplified types
        static::assertMatchesRegularExpression('/(int|varchar|text|timestamp)/', $mermaid);
    }
}
