<?php

namespace Tests\Feature\Administration;

use App\Domain\Identity\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create an authenticated user for requests.
     */
    private function authUser(): User
    {
        return User::factory()->create();
    }

    /**
     * Test that the users index page loads successfully.
     */
    public function test_users_page_loads(): void
    {
        $user = $this->authUser();

        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    /**
     * Test that the API endpoint lists all users.
     */
    public function test_api_lists_all_users(): void
    {
        $user = $this->authUser();
        User::factory()->count(3)->create();

        $response = $this->actingAs($user)->getJson('/admin/users/api');

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

        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];
        static::assertEquals(4, $pagination['total']);
    }

    /**
     * Test pagination with default per_page.
     */
    public function test_api_pagination_with_default_per_page(): void
    {
        $user = $this->authUser();
        User::factory()->count(15)->create();

        $response = $this->actingAs($user)->getJson('/admin/users/api');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];
        /** @var array<int, mixed> $users */
        $users = $data['users'];

        static::assertEquals(10, $pagination['per_page']);
        static::assertEquals(1, $pagination['current_page']);
        static::assertEquals(16, $pagination['total']);
        static::assertEquals(2, $pagination['last_page']);
        static::assertCount(10, $users);
    }

    /**
     * Test pagination with custom per_page.
     */
    public function test_api_pagination_with_custom_per_page(): void
    {
        $user = $this->authUser();
        User::factory()->count(30)->create();

        $response = $this->actingAs($user)->getJson('/admin/users/api?per_page=25');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];
        /** @var array<int, mixed> $users */
        $users = $data['users'];

        static::assertEquals(25, $pagination['per_page']);
        static::assertEquals(2, $pagination['last_page']);
        static::assertCount(25, $users);
    }

    /**
     * Test pagination respects maximum per_page.
     */
    public function test_api_pagination_max_per_page_limit(): void
    {
        $user = $this->authUser();
        User::factory()->count(5)->create();

        $response = $this->actingAs($user)->getJson('/admin/users/api?per_page=999');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];

        static::assertEquals(100, $pagination['per_page']);
    }

    /**
     * Test pagination respects minimum per_page.
     */
    public function test_api_pagination_min_per_page_limit(): void
    {
        $user = $this->authUser();
        User::factory()->count(5)->create();

        $response = $this->actingAs($user)->getJson('/admin/users/api?per_page=0');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];

        static::assertEquals(1, $pagination['per_page']);
    }

    /**
     * Test pagination second page.
     */
    public function test_api_pagination_second_page(): void
    {
        $user = $this->authUser();
        User::factory()->count(15)->create();

        $response = $this->actingAs($user)->getJson('/admin/users/api?page=2&per_page=10');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];
        /** @var array<int, mixed> $users */
        $users = $data['users'];

        static::assertEquals(2, $pagination['current_page']);
        static::assertCount(6, $users);
    }

    /**
     * Test search users by name.
     */
    public function test_api_search_users_by_name(): void
    {
        $user = $this->authUser();
        User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);
        User::factory()->create(['name' => 'Jane Smith', 'email' => 'jane@example.com']);
        User::factory()->create(['name' => 'Bob Johnson', 'email' => 'bob@example.com']);

        $response = $this->actingAs($user)->getJson('/admin/users/api/search?q=John');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];
        /** @var array<int, array<string, mixed>> $users */
        $users = $data['users'];

        static::assertEquals(2, $pagination['total']);
        static::assertTrue(
            collect($users)->contains('name', 'John Doe') &&
            collect($users)->contains('name', 'Bob Johnson')
        );
    }

    /**
     * Test search users by email.
     */
    public function test_api_search_users_by_email(): void
    {
        $user = $this->authUser();
        User::factory()->create(['name' => 'Test User', 'email' => 'test@example.com']);
        User::factory()->create(['name' => 'Another User', 'email' => 'another@test.com']);
        User::factory()->create(['name' => 'Different User', 'email' => 'user@different.com']);

        $response = $this->actingAs($user)->getJson('/admin/users/api/search?q=test');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];

        static::assertEquals(2, $pagination['total']);
    }

    /**
     * Test search with no results.
     */
    public function test_api_search_users_no_results(): void
    {
        $user = $this->authUser();
        User::factory()->count(5)->create();

        $response = $this->actingAs($user)->getJson('/admin/users/api/search?q=nonexistent');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];
        /** @var array<int, mixed> $users */
        $users = $data['users'];

        static::assertEquals(0, $pagination['total']);
        static::assertCount(0, $users);
    }

    /**
     * Test search with pagination.
     */
    public function test_api_search_with_pagination(): void
    {
        $user = $this->authUser();
        for ($i = 1; $i <= 20; $i++) {
            User::factory()->create(['name' => "Test User {$i}", 'email' => "test{$i}@example.com"]);
        }

        $response = $this->actingAs($user)->getJson('/admin/users/api/search?q=Test&per_page=5&page=2');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];
        /** @var array<int, mixed> $users */
        $users = $data['users'];

        static::assertEquals(2, $pagination['current_page']);
        static::assertEquals(5, $pagination['per_page']);
        static::assertEquals(20, $pagination['total']);
        static::assertCount(5, $users);
    }

    /**
     * Test search is case insensitive.
     */
    public function test_api_search_is_case_insensitive(): void
    {
        $user = $this->authUser();
        User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);

        $response = $this->actingAs($user)->getJson('/admin/users/api/search?q=JOHN');

        $response->assertStatus(200);
        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $pagination */
        $pagination = $data['pagination'];

        static::assertEquals(1, $pagination['total']);
    }

    /**
     * Test creating a new user via API.
     */
    public function test_api_creates_user(): void
    {
        $user = $this->authUser();
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $response = $this->actingAs($user)->postJson('/admin/users/api', $userData);

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

        static::assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    /**
     * Test creating a user with roles.
     */
    public function test_api_creates_user_with_roles(): void
    {
        $user = $this->authUser();
        $role = Role::create(['name' => 'admin']);

        $userData = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'roles' => ['admin'],
        ];

        $response = $this->actingAs($user)->postJson('/admin/users/api', $userData);

        $response->assertStatus(201);

        $createdUser = User::where('email', 'admin@example.com')->first();
        static::assertNotNull($createdUser);
        static::assertTrue($createdUser->hasRole('admin'));
    }

    /**
     * Test that user creation validates required fields.
     */
    public function test_api_validates_required_fields_on_create(): void
    {
        $user = $this->authUser();

        $response = $this->actingAs($user)->postJson('/admin/users/api', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /**
     * Test that user creation validates email uniqueness.
     */
    public function test_api_validates_email_uniqueness_on_create(): void
    {
        $user = $this->authUser();
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->actingAs($user)->postJson('/admin/users/api', [
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
        $user = $this->authUser();
        $targetUser = User::factory()->create();

        $response = $this->actingAs($user)->getJson("/admin/users/api/{$targetUser->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
            ],
        ]);

        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<string, mixed> $userData */
        $userData = $data['user'];
        static::assertEquals($targetUser->id, $userData['id']);
        static::assertEquals($targetUser->email, $userData['email']);
    }

    /**
     * Test updating a user.
     */
    public function test_api_updates_user(): void
    {
        $user = $this->authUser();
        $targetUser = User::factory()->create([
            'name' => 'Original Name',
            'email' => 'original@example.com',
        ]);

        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $response = $this->actingAs($user)->putJson("/admin/users/api/{$targetUser->id}", $updateData);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'user',
        ]);

        static::assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    /**
     * Test updating a user's password.
     */
    public function test_api_updates_user_password(): void
    {
        $user = $this->authUser();
        $targetUser = User::factory()->create();
        $originalPassword = $targetUser->password;

        $updateData = [
            'name' => $targetUser->name,
            'email' => $targetUser->email,
            'password' => 'newpassword123',
        ];

        $response = $this->actingAs($user)->putJson("/admin/users/api/{$targetUser->id}", $updateData);

        $response->assertStatus(200);

        $targetUser->refresh();
        static::assertNotEquals($originalPassword, $targetUser->password);
    }

    /**
     * Test updating a user without changing password.
     */
    public function test_api_updates_user_without_password(): void
    {
        $user = $this->authUser();
        $targetUser = User::factory()->create();
        $originalPassword = $targetUser->password;

        $updateData = [
            'name' => 'Updated Name',
            'email' => $targetUser->email,
        ];

        $response = $this->actingAs($user)->putJson("/admin/users/api/{$targetUser->id}", $updateData);

        $response->assertStatus(200);

        $targetUser->refresh();
        static::assertEquals($originalPassword, $targetUser->password);
    }

    /**
     * Test updating user roles.
     */
    public function test_api_updates_user_roles(): void
    {
        $user = $this->authUser();
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);

        $targetUser = User::factory()->create();
        $targetUser->assignRole('admin');

        $updateData = [
            'name' => $targetUser->name,
            'email' => $targetUser->email,
            'roles' => ['editor'],
        ];

        $response = $this->actingAs($user)->putJson("/admin/users/api/{$targetUser->id}", $updateData);

        $response->assertStatus(200);

        $targetUser->refresh();
        static::assertFalse($targetUser->hasRole('admin'));
        static::assertTrue($targetUser->hasRole('editor'));
    }

    /**
     * Test that email uniqueness is validated during update.
     */
    public function test_api_validates_email_uniqueness_on_update(): void
    {
        $user = $this->authUser();
        $user1 = User::factory()->create(['email' => 'user1@example.com']);
        $user2 = User::factory()->create(['email' => 'user2@example.com']);

        $response = $this->actingAs($user)->putJson("/admin/users/api/{$user1->id}", [
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
        $user = $this->authUser();
        $targetUser = User::factory()->create(['email' => 'test@example.com']);

        $response = $this->actingAs($user)->putJson("/admin/users/api/{$targetUser->id}", [
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
        $user = $this->authUser();
        $targetUser = User::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/admin/users/api/{$targetUser->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Utilisateur supprimé avec succès',
        ]);

        static::assertDatabaseMissing('users', [
            'id' => $targetUser->id,
        ]);
    }

    /**
     * Test that validation errors are properly formatted.
     */
    public function test_api_returns_proper_validation_errors(): void
    {
        $user = $this->authUser();

        $response = $this->actingAs($user)->postJson('/admin/users/api', [
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
        $user = $this->authUser();
        $role = Role::create(['name' => 'admin']);
        $targetUser = User::factory()->create();
        $targetUser->assignRole('admin');

        $response = $this->actingAs($user)->getJson('/admin/users/api');

        $response->assertStatus(200);

        /** @var array<string, mixed> $data */
        $data = $response->json();
        /** @var array<int, array<string, mixed>> $users */
        $users = $data['users'];
        /** @var array<string, mixed>|null $userData */
        $userData = collect($users)->firstWhere('id', $targetUser->id);

        static::assertNotNull($userData);
        static::assertArrayHasKey('roles', $userData);
        /** @var array<int, array<string, mixed>> $roles */
        $roles = $userData['roles'];
        static::assertCount(1, $roles);
        static::assertEquals('admin', $roles[0]['name']);
    }
}
