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
            'count',
        ]);

        $data = $response->json();
        $this->assertEquals(3, $data['count']);
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
