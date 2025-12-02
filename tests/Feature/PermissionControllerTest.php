<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the permissions index page loads successfully.
     */
    public function test_permissions_page_loads(): void
    {
        $response = $this->get('/permissions');
        $response->assertStatus(200);
        $response->assertViewIs('permissions.index');
    }

    /**
     * Test that the users API endpoint lists all users with roles and permissions.
     */
    public function test_api_lists_users_with_roles_and_permissions(): void
    {
        // Create permissions
        $viewPosts = Permission::create(['name' => 'view posts']);
        $editPosts = Permission::create(['name' => 'edit posts']);

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        // Assign permissions to roles
        $admin->givePermissionTo([$viewPosts, $editPosts]);
        $editor->givePermissionTo([$viewPosts]);

        // Create users and assign roles
        $adminUser = User::factory()->create(['name' => 'Admin User']);
        $adminUser->assignRole('admin');

        $editorUser = User::factory()->create(['name' => 'Editor User']);
        $editorUser->assignRole('editor');

        $response = $this->getJson('/permissions/api/users');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'users' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'roles' => [
                        '*' => [
                            'id',
                            'name',
                            'permissions' => [
                                '*' => [
                                    'id',
                                    'name',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'count',
        ]);

        $data = $response->json();
        $this->assertEquals(2, $data['count']);

        // Verify admin user has correct roles and permissions
        $adminData = collect($data['users'])->firstWhere('name', 'Admin User');
        $this->assertCount(1, $adminData['roles']);
        $this->assertEquals('admin', $adminData['roles'][0]['name']);
        $this->assertCount(2, $adminData['roles'][0]['permissions']);

        // Verify editor user has correct roles and permissions
        $editorData = collect($data['users'])->firstWhere('name', 'Editor User');
        $this->assertCount(1, $editorData['roles']);
        $this->assertEquals('editor', $editorData['roles'][0]['name']);
        $this->assertCount(1, $editorData['roles'][0]['permissions']);
    }

    /**
     * Test that users without roles are included in the response.
     */
    public function test_api_includes_users_without_roles(): void
    {
        $user = User::factory()->create(['name' => 'Regular User']);

        $response = $this->getJson('/permissions/api/users');

        $response->assertStatus(200);

        $data = $response->json();
        $this->assertEquals(1, $data['count']);

        $userData = $data['users'][0];
        $this->assertEquals('Regular User', $userData['name']);
        $this->assertArrayHasKey('roles', $userData);
        $this->assertCount(0, $userData['roles']);
    }

    /**
     * Test that the permissions API lists all permissions with roles.
     */
    public function test_api_lists_permissions_with_roles(): void
    {
        $permission = Permission::create(['name' => 'view posts']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo($permission);

        $response = $this->getJson('/permissions/api/permissions');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'permissions' => [
                '*' => [
                    'id',
                    'name',
                    'guard_name',
                    'roles',
                ],
            ],
            'count',
        ]);
    }

    /**
     * Test that the roles API lists all roles with permissions.
     */
    public function test_api_lists_roles_with_permissions(): void
    {
        $permission = Permission::create(['name' => 'view posts']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo($permission);

        $response = $this->getJson('/permissions/api/roles');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'roles' => [
                '*' => [
                    'id',
                    'name',
                    'guard_name',
                    'permissions',
                ],
            ],
            'count',
        ]);
    }

    /**
     * Test that a user with multiple roles shows all permissions correctly.
     */
    public function test_user_with_multiple_roles_shows_all_permissions(): void
    {
        // Create permissions
        $viewPosts = Permission::create(['name' => 'view posts']);
        $editPosts = Permission::create(['name' => 'edit posts']);
        $deletePosts = Permission::create(['name' => 'delete posts']);

        // Create roles with different permissions
        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo([$viewPosts, $editPosts]);

        $moderator = Role::create(['name' => 'moderator']);
        $moderator->givePermissionTo([$deletePosts]);

        // Create user with multiple roles
        $user = User::factory()->create(['name' => 'Multi-Role User']);
        $user->assignRole(['editor', 'moderator']);

        $response = $this->getJson('/permissions/api/users');

        $response->assertStatus(200);

        $data = $response->json();
        $userData = collect($data['users'])->firstWhere('name', 'Multi-Role User');

        $this->assertCount(2, $userData['roles']);

        // Collect all permission names from all roles
        $allPermissions = collect($userData['roles'])
            ->flatMap(fn($role) => $role['permissions'])
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();

        $this->assertContains('view posts', $allPermissions);
        $this->assertContains('edit posts', $allPermissions);
        $this->assertContains('delete posts', $allPermissions);
    }
}
