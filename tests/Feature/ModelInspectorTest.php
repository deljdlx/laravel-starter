<?php

namespace Tests\Feature;

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

        // Verify we have at least the User and Task models
        $data = $response->json();
        $this->assertGreaterThanOrEqual(2, $data['count']);

        $modelNames = array_column($data['models'], 'short_name');
        $this->assertContains('User', $modelNames);
        $this->assertContains('Task', $modelNames);
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

        $data = $response->json();
        $this->assertEquals('User', $data['short_name']);
        $this->assertEquals('App\\Models\\User', $data['class']);
        $this->assertEquals('users', $data['table']);
        $this->assertEquals('id', $data['primary_key']);
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

        $data = $response->json();

        // Check fillable attributes
        $this->assertIsArray($data['attributes']['fillable']);
        $this->assertContains('name', $data['attributes']['fillable']);
        $this->assertContains('email', $data['attributes']['fillable']);

        // Check hidden attributes
        $this->assertIsArray($data['attributes']['hidden']);
        $this->assertContains('password', $data['attributes']['hidden']);

        // Check casts
        $this->assertIsArray($data['attributes']['casts']);
        $this->assertNotEmpty($data['attributes']['casts']);
    }

    /**
     * Test that database schema is correctly retrieved.
     */
    public function test_database_schema_is_retrieved(): void
    {
        $response = $this->getJson('/dev/api/models/User');

        $data = $response->json();

        // Check schema structure exists
        $this->assertArrayHasKey('schema', $data);
        $this->assertArrayHasKey('columns', $data['schema']);
        $this->assertArrayHasKey('indexes', $data['schema']);

        // Check that columns is an array (may be empty if DB not migrated in test)
        $this->assertIsArray($data['schema']['columns']);
        $this->assertIsArray($data['schema']['indexes']);

        // If columns exist, verify their structure
        if (! empty($data['schema']['columns'])) {
            $column = $data['schema']['columns'][0];
            $this->assertArrayHasKey('name', $column);
            $this->assertArrayHasKey('type', $column);
            $this->assertArrayHasKey('nullable', $column);
            $this->assertArrayHasKey('default', $column);
        }
    }

    /**
     * Test that relationships are correctly detected.
     */
    public function test_relationships_are_detected(): void
    {
        $response = $this->getJson('/dev/api/models/User');

        $data = $response->json();

        $this->assertIsArray($data['relationships']);
        $this->assertNotEmpty($data['relationships']);

        // Verify relationship structure
        $relationship = $data['relationships'][0];
        $this->assertArrayHasKey('name', $relationship);
        $this->assertArrayHasKey('type', $relationship);
        $this->assertArrayHasKey('related_model', $relationship);
    }
}
