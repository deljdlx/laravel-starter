<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the users index page loads successfully.
     */
    public function test_users_page_loads(): void
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    /**
     * Test that the API endpoint lists all users.
     */
    public function test_api_lists_all_users(): void
    {
        // Create test users
        User::factory()->count(3)->create();

        $response = $this->getJson('/users/api');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'users' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                ],
            ],
            'pagination' => [
                'current_page',
                'per_page',
                'total',
                'last_page',
                'from',
                'to',
            ],
        ]);

        $data = $response->json();
        $this->assertEquals(3, $data['pagination']['total']);
    }

    /**
     * Test pagination with default per_page.
     */
    public function test_api_pagination_with_default_per_page(): void
    {
        User::factory()->count(15)->create();

        $response = $this->getJson('/users/api');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(10, $data['pagination']['per_page']);
        $this->assertEquals(1, $data['pagination']['current_page']);
        $this->assertEquals(15, $data['pagination']['total']);
        $this->assertEquals(2, $data['pagination']['last_page']);
        $this->assertCount(10, $data['users']);
    }

    /**
     * Test pagination with custom per_page.
     */
    public function test_api_pagination_with_custom_per_page(): void
    {
        User::factory()->count(30)->create();

        $response = $this->getJson('/users/api?per_page=25');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(25, $data['pagination']['per_page']);
        $this->assertEquals(2, $data['pagination']['last_page']);
        $this->assertCount(25, $data['users']);
    }

    /**
     * Test pagination respects maximum per_page.
     */
    public function test_api_pagination_max_per_page_limit(): void
    {
        User::factory()->count(5)->create();

        $response = $this->getJson('/users/api?per_page=999');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(100, $data['pagination']['per_page']);
    }

    /**
     * Test pagination respects minimum per_page.
     */
    public function test_api_pagination_min_per_page_limit(): void
    {
        User::factory()->count(5)->create();

        $response = $this->getJson('/users/api?per_page=0');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(1, $data['pagination']['per_page']);
    }

    /**
     * Test pagination second page.
     */
    public function test_api_pagination_second_page(): void
    {
        User::factory()->count(15)->create();

        $response = $this->getJson('/users/api?page=2&per_page=10');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(2, $data['pagination']['current_page']);
        $this->assertCount(5, $data['users']);
    }

    /**
     * Test search users by name.
     */
    public function test_api_search_users_by_name(): void
    {
        User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);
        User::factory()->create(['name' => 'Jane Smith', 'email' => 'jane@example.com']);
        User::factory()->create(['name' => 'Bob Johnson', 'email' => 'bob@example.com']);

        $response = $this->getJson('/users/api/search?q=John');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(2, $data['pagination']['total']);
        $this->assertTrue(
            collect($data['users'])->contains('name', 'John Doe') &&
            collect($data['users'])->contains('name', 'Bob Johnson')
        );
    }

    /**
     * Test search users by email.
     */
    public function test_api_search_users_by_email(): void
    {
        User::factory()->create(['name' => 'Test User', 'email' => 'test@example.com']);
        User::factory()->create(['name' => 'Another User', 'email' => 'another@test.com']);
        User::factory()->create(['name' => 'Different User', 'email' => 'user@different.com']);

        $response = $this->getJson('/users/api/search?q=test');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(2, $data['pagination']['total']);
    }

    /**
     * Test search with no results.
     */
    public function test_api_search_users_no_results(): void
    {
        User::factory()->count(5)->create();

        $response = $this->getJson('/users/api/search?q=nonexistent');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(0, $data['pagination']['total']);
        $this->assertCount(0, $data['users']);
    }

    /**
     * Test search with pagination.
     */
    public function test_api_search_with_pagination(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            User::factory()->create(['name' => "Test User {$i}", 'email' => "test{$i}@example.com"]);
        }

        $response = $this->getJson('/users/api/search?q=Test&per_page=5&page=2');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(2, $data['pagination']['current_page']);
        $this->assertEquals(5, $data['pagination']['per_page']);
        $this->assertEquals(20, $data['pagination']['total']);
        $this->assertCount(5, $data['users']);
    }

    /**
     * Test search is case insensitive.
     */
    public function test_api_search_is_case_insensitive(): void
    {
        User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);

        $response = $this->getJson('/users/api/search?q=JOHN');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertEquals(1, $data['pagination']['total']);
    }

    /**
     * Test creating a new user via API.
     */
    public function test_api_creates_user(): void
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/users/api', $userData);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'user' => [
                'id',
                'name',
                'email',
                'created_at',
            ],
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    /**
     * Test creating a user with roles.
     */
    public function test_api_creates_user_with_roles(): void
    {
        $role = Role::create(['name' => 'admin']);

        $userData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'roles' => ['admin'],
        ];

        $response = $this->postJson('/users/api', $userData);

        $response->assertStatus(201);

        $user = User::where('email', 'admin@example.com')->first();
        $this->assertTrue($user->hasRole('admin'));
    }

    /**
     * Test that user creation validates required fields.
     */
    public function test_api_validates_required_fields_on_create(): void
    {
        $response = $this->postJson('/users/api', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /**
     * Test that user creation validates email uniqueness.
     */
    public function test_api_validates_email_uniqueness_on_create(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->postJson('/users/api', [
            'name' => 'Test User',
            'email' => 'existing@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    /**
     * Test showing a specific user.
     */
    public function test_api_shows_user(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson("/users/api/{$user->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
            ],
        ]);

        $data = $response->json();
        $this->assertEquals($user->id, $data['user']['id']);
        $this->assertEquals($user->email, $data['user']['email']);
    }

    /**
     * Test updating a user.
     */
    public function test_api_updates_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Original Name',
            'email' => 'original@example.com',
        ]);

        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $response = $this->putJson("/users/api/{$user->id}", $updateData);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'user',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    /**
     * Test updating a user's password.
     */
    public function test_api_updates_user_password(): void
    {
        $user = User::factory()->create();
        $originalPassword = $user->password;

        $updateData = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'newpassword123',
        ];

        $response = $this->putJson("/users/api/{$user->id}", $updateData);

        $response->assertStatus(200);

        $user->refresh();
        $this->assertNotEquals($originalPassword, $user->password);
    }

    /**
     * Test updating a user without changing password.
     */
    public function test_api_updates_user_without_password(): void
    {
        $user = User::factory()->create();
        $originalPassword = $user->password;

        $updateData = [
            'name' => 'Updated Name',
            'email' => $user->email,
        ];

        $response = $this->putJson("/users/api/{$user->id}", $updateData);

        $response->assertStatus(200);

        $user->refresh();
        $this->assertEquals($originalPassword, $user->password);
    }

    /**
     * Test updating user roles.
     */
    public function test_api_updates_user_roles(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);

        $user = User::factory()->create();
        $user->assignRole('admin');

        $updateData = [
            'name' => $user->name,
            'email' => $user->email,
            'roles' => ['editor'],
        ];

        $response = $this->putJson("/users/api/{$user->id}", $updateData);

        $response->assertStatus(200);

        $user->refresh();
        $this->assertFalse($user->hasRole('admin'));
        $this->assertTrue($user->hasRole('editor'));
    }

    /**
     * Test that email uniqueness is validated during update.
     */
    public function test_api_validates_email_uniqueness_on_update(): void
    {
        $user1 = User::factory()->create(['email' => 'user1@example.com']);
        $user2 = User::factory()->create(['email' => 'user2@example.com']);

        $response = $this->putJson("/users/api/{$user1->id}", [
            'name' => $user1->name,
            'email' => 'user2@example.com',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    /**
     * Test that a user can be updated with the same email.
     */
    public function test_api_allows_same_email_on_update(): void
    {
        $user = User::factory()->create(['email' => 'test@example.com']);

        $response = $this->putJson("/users/api/{$user->id}", [
            'name' => 'New Name',
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test deleting a user.
     */
    public function test_api_deletes_user(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/users/api/{$user->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Utilisateur supprimé avec succès',
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    /**
     * Test that validation errors are properly formatted.
     */
    public function test_api_returns_proper_validation_errors(): void
    {
        $response = $this->postJson('/users/api', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /**
     * Test that users are loaded with their roles relationship.
     */
    public function test_api_loads_users_with_roles(): void
    {
        $role = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->getJson('/users/api');

        $response->assertStatus(200);

        $data = $response->json();
        $userData = collect($data['users'])->firstWhere('id', $user->id);

        $this->assertArrayHasKey('roles', $userData);
        $this->assertCount(1, $userData['roles']);
        $this->assertEquals('admin', $userData['roles'][0]['name']);
    }
}
