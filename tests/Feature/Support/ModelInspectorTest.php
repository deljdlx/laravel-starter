<?php

namespace Tests\Feature\Support;

use Tests\TestCase;

class ModelInspectorTest extends TestCase
{
    /**
     * Test that the model inspector index page loads successfully.
     */
    public function test_model_inspector_page_loads(): void
    {
        $response = $this->get('/dev/models');
        $response->assertStatus(200);
        $response->assertViewIs('dev.models.index');
    }

    /**
     * Test that the API endpoint lists all models.
     */
    public function test_api_lists_all_models(): void
    {
        $response = $this->getJson('/dev/api/models');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'models' => [
                '*' => [
                    'class',
                    'short_name',
                    'table',
                    'connection',
                    'primary_key',
                    'timestamps',
                ],
            ],
            'count',
        ]);

        /** @var array<string, mixed> $data */
        $data = $response->json();
        static::assertGreaterThanOrEqual(2, $data['count']);

        /** @var array<int, array<string, mixed>> $models */
        $models = $data['models'];
        $modelNames = array_column($models, 'short_name');
        static::assertContains('User', $modelNames);
        static::assertContains('Task', $modelNames);
    }

    /**
     * Test that the API endpoint returns detailed information for a specific model.
     */
    public function test_api_shows_model_details(): void
    {
        $response = $this->getJson('/dev/api/models/User');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'class',
            'short_name',
            'table',
            'connection',
            'primary_key',
            'timestamps',
            'attributes' => [
                'fillable',
                'guarded',
                'casts',
                'hidden',
            ],
            'relationships',
            'schema' => [
                'columns',
                'indexes',
            ],
        ]);

        /** @var array<string, mixed> $data */
        $data = $response->json();
        static::assertEquals('User', $data['short_name']);
        static::assertEquals('App\\Domain\\Identity\\Models\\User', $data['class']);
        static::assertEquals('users', $data['table']);
        static::assertEquals('id', $data['primary_key']);
    }

    /**
     * Test that the API returns 404 for a non-existent model.
     */
    public function test_api_returns_404_for_non_existent_model(): void
    {
        $response = $this->getJson('/dev/api/models/NonExistentModel');

        $response->assertStatus(404);
        $response->assertJsonStructure(['error']);
    }

    /**
     * Test that model attributes are correctly retrieved.
     */
    public function test_model_attributes_are_retrieved(): void
    {
        $response = $this->getJson('/dev/api/models/User');

        /** @var array<string, mixed> $data */
        $data = $response->json();

        /** @var array<string, mixed> $attributes */
        $attributes = $data['attributes'];

        // Check fillable attributes
        static::assertIsArray($attributes['fillable']);
        static::assertContains('name', $attributes['fillable']);
        static::assertContains('email', $attributes['fillable']);

        // Check hidden attributes
        static::assertIsArray($attributes['hidden']);
        static::assertContains('password', $attributes['hidden']);

        // Check casts
        static::assertIsArray($attributes['casts']);
        static::assertNotEmpty($attributes['casts']);
    }

    /**
     * Test that database schema is correctly retrieved.
     */
    public function test_database_schema_is_retrieved(): void
    {
        $response = $this->getJson('/dev/api/models/User');

        /** @var array<string, mixed> $data */
        $data = $response->json();

        /** @var array<string, mixed> $schema */
        $schema = $data['schema'];

        // Check schema structure exists
        static::assertArrayHasKey('schema', $data);
        static::assertArrayHasKey('columns', $schema);
        static::assertArrayHasKey('indexes', $schema);

        // Check that columns is an array (may be empty if DB not migrated in test)
        static::assertIsArray($schema['columns']);
        static::assertIsArray($schema['indexes']);

        /** @var array<int, array<string, mixed>> $columns */
        $columns = $schema['columns'];

        // If columns exist, verify their structure
        if (count($columns) > 0) {
            $column = $columns[0];
            static::assertArrayHasKey('name', $column);
            static::assertArrayHasKey('type', $column);
            static::assertArrayHasKey('nullable', $column);
            static::assertArrayHasKey('default', $column);
        }
    }

    /**
     * Test that relationships are correctly detected.
     */
    public function test_relationships_are_detected(): void
    {
        $response = $this->getJson('/dev/api/models/User');

        /** @var array<string, mixed> $data */
        $data = $response->json();

        $relationships = $data['relationships'];

        static::assertIsArray($relationships);
        static::assertNotEmpty($relationships);

        /** @var array<int, array<string, mixed>> $typedRelationships */
        $typedRelationships = $relationships;

        // Verify relationship structure
        $relationship = $typedRelationships[0];
        static::assertArrayHasKey('name', $relationship);
        static::assertArrayHasKey('type', $relationship);
        static::assertArrayHasKey('related_model', $relationship);
    }
}
