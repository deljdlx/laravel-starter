<?php

namespace Tests\Feature\Administration;

use App\Domain\Identity\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
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
     * Test that the permissions index page loads successfully.
     */
    public function test_permissions_page_loads(): void
    {
        $user = $this->authUser();

        $response = $this->actingAs($user)->get('/admin/permissions');
        $response->assertStatus(200);
        $response->assertViewIs('permissions.index');
    }

    /**
     * Test that the users API endpoint lists all users with roles and permissions.
     */
    public function test_api_lists_users_with_roles_and_permissions(): void
    {
        $user = $this->authUser();

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

        $response = $this->actingAs($user)->getJson('/admin/permissions/api/users');

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

        /** @var array<string, mixed> $data */
        $data = $response->json();
        static::assertEquals(3, $data['count']);

        /** @var array<int, array<string, mixed>> $users */
        $users = $data['users'];

        // Verify admin user has correct roles and permissions
        /** @var array<string, mixed> $adminData */
        $adminData = collect($users)->firstWhere('name', 'Admin User');
        /** @var array<int, array<string, mixed>> $adminRoles */
        $adminRoles = $adminData['roles'];
        static::assertCount(1, $adminRoles);
        static::assertEquals('admin', $adminRoles[0]['name']);
        /** @var array<int, array<string, mixed>> $adminPermissions */
        $adminPermissions = $adminRoles[0]['permissions'];
        static::assertCount(2, $adminPermissions);

        // Verify editor user has correct roles and permissions
        /** @var array<string, mixed> $editorData */
        $editorData = collect($users)->firstWhere('name', 'Editor User');
        /** @var array<int, array<string, mixed>> $editorRoles */
        $editorRoles = $editorData['roles'];
        static::assertCount(1, $editorRoles);
        static::assertEquals('editor', $editorRoles[0]['name']);
        /** @var array<int, array<string, mixed>> $editorPermissions */
        $editorPermissions = $editorRoles[0]['permissions'];
        static::assertCount(1, $editorPermissions);
    }

    /**
     * Test that users without roles are included in the response.
     */
    public function test_api_includes_users_without_roles(): void
    {
        $user = User::factory()->create(['name' => 'Regular User']);

        $response = $this->actingAs($user)->getJson('/admin/permissions/api/users');

        $response->assertStatus(200);

        /** @var array<string, mixed> $data */
        $data = $response->json();
        static::assertEquals(1, $data['count']);

        /** @var array<int, array<string, mixed>> $users */
        $users = $data['users'];
        /** @var array<string, mixed> $userData */
        $userData = $users[0];
        static::assertEquals('Regular User', $userData['name']);
        static::assertArrayHasKey('roles', $userData);
        /** @var array<int, mixed> $roles */
        $roles = $userData['roles'];
        static::assertCount(0, $roles);
    }

    /**
     * Test that the permissions API lists all permissions with roles.
     */
    public function test_api_lists_permissions_with_roles(): void
    {
        $user = $this->authUser();
        $permission = Permission::create(['name' => 'view posts']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo($permission);

        $response = $this->actingAs($user)->getJson('/admin/permissions/api/permissions');

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
        $user = $this->authUser();
        $permission = Permission::create(['name' => 'view posts']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo($permission);

        $response = $this->actingAs($user)->getJson('/admin/permissions/api/roles');

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
        $authUser = $this->authUser();

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

        $response = $this->actingAs($authUser)->getJson('/admin/permissions/api/users');

        $response->assertStatus(200);

        /** @var array<string, mixed> $data */
        $data = $response->json();

        /** @var array<int, array<string, mixed>> $users */
        $users = $data['users'];

        /** @var array<string, mixed> $userData */
        $userData = collect($users)->firstWhere('name', 'Multi-Role User');

        /** @var array<int, array<string, mixed>> $userRoles */
        $userRoles = $userData['roles'];
        static::assertCount(2, $userRoles);

        // Collect all permission names from all roles
        /** @var array<int, string> $allPermissions */
        $allPermissions = collect($userRoles)
            ->flatMap(function (array $role): array {
                /** @var array<int, array<string, mixed>> $permissions */
                $permissions = $role['permissions'];

                return $permissions;
            })
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();

        static::assertContains('view posts', $allPermissions);
        static::assertContains('edit posts', $allPermissions);
        static::assertContains('delete posts', $allPermissions);
    }
}
