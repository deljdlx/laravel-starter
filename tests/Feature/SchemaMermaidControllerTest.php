<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchemaMermaidControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the schema mermaid page loads successfully
     */
    public function test_schema_mermaid_page_loads(): void
    {
        $response = $this->get('/dev/schema-mermaid');
        
        $response->assertStatus(200);
        $response->assertViewIs('dev.schema-mermaid.index');
    }

    /**
     * Test that the page contains Mermaid code
     */
    public function test_page_contains_mermaid_code(): void
    {
        $response = $this->get('/dev/schema-mermaid');
        
        $response->assertStatus(200);
        $response->assertSee('erDiagram', false);
    }

    /**
     * Test that the page contains table definitions
     */
    public function test_page_contains_table_definitions(): void
    {
        $response = $this->get('/dev/schema-mermaid');
        
        $response->assertStatus(200);
        // Should contain USERS and TASKS tables
        $response->assertSee('USERS', false);
        $response->assertSee('TASKS', false);
    }

    /**
     * Test that the page contains relationships
     */
    public function test_page_contains_relationships(): void
    {
        $response = $this->get('/dev/schema-mermaid');
        
        $response->assertStatus(200);
        // Should contain relationship syntax
        $response->assertSee('has many', false);
    }

    /**
     * Test that the page contains key markers
     */
    public function test_page_contains_key_markers(): void
    {
        $response = $this->get('/dev/schema-mermaid');
        
        $response->assertStatus(200);
        // Should mark primary keys
        $response->assertSee('PK', false);
        // Should mark foreign keys
        $response->assertSee('FK', false);
    }
}
