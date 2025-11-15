<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;

class ModelBuilderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Clean up any test-generated files before each test
        $this->cleanupGeneratedFiles();
    }

    protected function tearDown(): void
    {
        // Clean up after each test
        $this->cleanupGeneratedFiles();
        
        parent::tearDown();
    }

    protected function cleanupGeneratedFiles(): void
    {
        // Clean up test model
        $testModelPath = app_path('Models/TestProduct.php');
        if (File::exists($testModelPath)) {
            File::delete($testModelPath);
        }

        // Clean up test migrations
        $migrations = File::glob(database_path('migrations/*_create_test_products_table.php'));
        foreach ($migrations as $migration) {
            File::delete($migration);
        }

        // Clean up pivot migrations
        $pivotMigrations = File::glob(database_path('migrations/*_create_*_test_product_table.php'));
        foreach ($pivotMigrations as $migration) {
            File::delete($migration);
        }

        // Clean up test factory
        $testFactoryPath = database_path('factories/TestProductFactory.php');
        if (File::exists($testFactoryPath)) {
            File::delete($testFactoryPath);
        }
    }

    public function test_model_builder_page_loads(): void
    {
        $response = $this->get('/dev/model-builder');
        
        $response->assertStatus(200);
        $response->assertViewIs('dev.model-builder.index');
        $response->assertViewHas('models');
    }

    public function test_model_builder_page_lists_available_models(): void
    {
        $response = $this->get('/dev/model-builder');
        
        $models = $response->viewData('models');
        
        $this->assertIsArray($models);
        $this->assertContains('User', $models);
    }

    public function test_preview_endpoint_returns_generated_code(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => false,
            'generate_migration' => true,
            'generate_factory' => true,
            'attributes' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => false,
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder/preview', $data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'files',
        ]);

        $files = $response->json('files');
        
        // Verify model source contains expected elements
        $this->assertStringContainsString('class TestProduct extends Model', $files['model']['source']);
        $this->assertStringContainsString('use HasFactory', $files['model']['source']);
        $this->assertStringContainsString('use HasUlids', $files['model']['source']);
        
        // Verify migration source
        $this->assertStringContainsString('Schema::create(\'test_products\'', $files['migration']['source']);
        $this->assertStringContainsString('$table->ulid(\'id\')->primary()', $files['migration']['source']);
        
        // Verify factory source
        $this->assertStringContainsString('class TestProductFactory extends Factory', $files['factory']['source']);
    }

    public function test_validation_requires_model_name(): void
    {
        $data = [
            'timestamps' => true,
            'soft_deletes' => false,
            'generate_migration' => true,
            'generate_factory' => true,
            'attributes' => [],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['model_name']);
    }

    public function test_validation_requires_pascal_case_model_name(): void
    {
        $data = [
            'model_name' => 'test_product', // snake_case instead of PascalCase
            'timestamps' => true,
            'soft_deletes' => false,
            'generate_migration' => true,
            'generate_factory' => true,
            'attributes' => [],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['model_name']);
    }

    public function test_generates_model_with_basic_attributes(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => false,
            'generate_migration' => true,
            'generate_factory' => true,
            'attributes' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => false,
                ],
                [
                    'name' => 'price',
                    'type' => 'decimal',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => false,
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Verify model file was created
        $this->assertFileExists(app_path('Models/TestProduct.php'));
        
        $modelContent = File::get(app_path('Models/TestProduct.php'));
        $this->assertStringContainsString('class TestProduct extends Model', $modelContent);
        $this->assertStringContainsString('use HasFactory, HasUlids', $modelContent);
        $this->assertStringContainsString('\'name\'', $modelContent);
        $this->assertStringContainsString('\'price\'', $modelContent);
    }

    public function test_generates_migration_when_requested(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => false,
            'generate_migration' => true,
            'generate_factory' => false,
            'attributes' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => false,
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(200);

        // Verify migration file was created
        $migrations = File::glob(database_path('migrations/*_create_test_products_table.php'));
        $this->assertCount(1, $migrations);
        
        $migrationContent = File::get($migrations[0]);
        $this->assertStringContainsString('Schema::create(\'test_products\'', $migrationContent);
        $this->assertStringContainsString('$table->ulid(\'id\')->primary()', $migrationContent);
        $this->assertStringContainsString('$table->string(\'name\')', $migrationContent);
    }

    public function test_generates_factory_when_requested(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => false,
            'generate_migration' => false,
            'generate_factory' => true,
            'attributes' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => false,
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(200);

        // Verify factory file was created
        $this->assertFileExists(database_path('factories/TestProductFactory.php'));
        
        $factoryContent = File::get(database_path('factories/TestProductFactory.php'));
        $this->assertStringContainsString('class TestProductFactory extends Factory', $factoryContent);
        // Modern Laravel factories use @extends annotation instead of protected $model
        $this->assertStringContainsString('@extends', $factoryContent);
    }

    public function test_generates_model_with_foreign_key_relationship(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => false,
            'generate_migration' => true,
            'generate_factory' => true,
            'attributes' => [
                [
                    'name' => 'user_id',
                    'type' => 'bigInteger',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => true,
                    'foreign_model' => 'User',
                    'relation_type' => 'belongsTo',
                    'on_delete' => 'cascade',
                    'on_update' => 'cascade',
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(200);

        $modelContent = File::get(app_path('Models/TestProduct.php'));
        
        // Verify relationship method is generated
        $this->assertStringContainsString('public function user(): BelongsTo', $modelContent);
        $this->assertStringContainsString('return $this->belongsTo(User::class)', $modelContent);
        
        // Verify migration has foreign key
        $migrations = File::glob(database_path('migrations/*_create_test_products_table.php'));
        $migrationContent = File::get($migrations[0]);
        $this->assertStringContainsString('$table->foreignUlid(\'user_id\')', $migrationContent);
        $this->assertStringContainsString('->onDelete(\'cascade\')', $migrationContent);
        $this->assertStringContainsString('->onUpdate(\'cascade\')', $migrationContent);
    }

    public function test_generates_pivot_migration_for_many_to_many(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => false,
            'generate_migration' => true,
            'generate_factory' => false,
            'attributes' => [
                [
                    'name' => '',
                    'type' => 'bigInteger',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => true,
                    'foreign_model' => 'User',
                    'relation_type' => 'belongsToMany',
                    'on_delete' => 'cascade',
                    'on_update' => 'cascade',
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(200);

        // Verify belongsToMany relationship in model
        $modelContent = File::get(app_path('Models/TestProduct.php'));
        $this->assertStringContainsString('public function users(): BelongsToMany', $modelContent);
        $this->assertStringContainsString('return $this->belongsToMany(User::class)', $modelContent);

        // Verify pivot migration was created
        $pivotMigrations = File::glob(database_path('migrations/*_create_test_product_user_table.php'));
        $this->assertCount(1, $pivotMigrations);
        
        $pivotContent = File::get($pivotMigrations[0]);
        $this->assertStringContainsString('Schema::create(\'test_product_user\'', $pivotContent);
        $this->assertStringContainsString('$table->foreignUlid(\'test_product_id\')', $pivotContent);
        $this->assertStringContainsString('$table->foreignUlid(\'user_id\')', $pivotContent);
        $this->assertStringContainsString('$table->primary([\'test_product_id\', \'user_id\'])', $pivotContent);
    }

    public function test_generates_model_with_has_statuses_trait(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => true,
            'generate_migration' => false,
            'generate_factory' => false,
            'attributes' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => false,
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(200);

        $modelContent = File::get(app_path('Models/TestProduct.php'));
        $this->assertStringContainsString('use Spatie\ModelStatus\HasStatuses', $modelContent);
        $this->assertStringContainsString('use HasFactory, HasUlids, HasStatuses', $modelContent);
    }

    public function test_generates_model_with_soft_deletes(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => true,
            'has_statuses' => false,
            'generate_migration' => true,
            'generate_factory' => false,
            'attributes' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => false,
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(200);

        $modelContent = File::get(app_path('Models/TestProduct.php'));
        $this->assertStringContainsString('use Illuminate\Database\Eloquent\SoftDeletes', $modelContent);
        $this->assertStringContainsString('use HasFactory, HasUlids, SoftDeletes', $modelContent);

        // Verify migration has softDeletes
        $migrations = File::glob(database_path('migrations/*_create_test_products_table.php'));
        $migrationContent = File::get($migrations[0]);
        $this->assertStringContainsString('$table->softDeletes()', $migrationContent);
    }

    public function test_prevents_overwriting_existing_model(): void
    {
        // Create a model first
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => false,
            'generate_migration' => false,
            'generate_factory' => false,
            'attributes' => [],
        ];

        $this->postJson('/dev/model-builder', $data);

        // Try to create it again
        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(422);
        $response->assertJsonFragment(['error' => 'Model TestProduct already exists']);
    }

    public function test_validates_attribute_names(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => false,
            'generate_migration' => false,
            'generate_factory' => false,
            'attributes' => [
                [
                    'name' => 'Invalid Name', // spaces not allowed
                    'type' => 'string',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => false,
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['attributes.0.name']);
    }

    public function test_returns_generated_file_paths_in_response(): void
    {
        $data = [
            'model_name' => 'TestProduct',
            'timestamps' => true,
            'soft_deletes' => false,
            'has_statuses' => false,
            'generate_migration' => true,
            'generate_factory' => true,
            'attributes' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'nullable' => false,
                    'index_type' => 'none',
                    'is_foreign_key' => false,
                ],
            ],
        ];

        $response = $this->postJson('/dev/model-builder', $data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'files' => [
                'model',
                'migration',
                'factory',
            ],
        ]);

        $files = $response->json('files');
        $this->assertStringContainsString('app/Models/TestProduct.php', $files['model']);
        $this->assertStringContainsString('database/migrations', $files['migration']);
        $this->assertStringContainsString('database/factories/TestProductFactory.php', $files['factory']);
    }
}
