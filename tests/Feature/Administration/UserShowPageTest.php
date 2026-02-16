<?php

namespace Tests\Feature\Administration;

use App\Domain\Identity\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserShowPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_show_page_displays_user_details(): void
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);

        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.users.show', $user));

        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertSee('john@example.com');
    }

    public function test_user_show_page_displays_roles(): void
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'editor', 'guard_name' => 'web']);

        $user = User::factory()->create();
        $user->assignRole('editor');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.users.show', $user));

        $response->assertStatus(200);
        $response->assertSee('editor');
    }

    public function test_user_show_page_requires_authentication(): void
    {
        $user = User::factory()->create();

        $response = $this->get(route('admin.users.show', $user));

        $response->assertRedirect(route('login'));
    }

    public function test_user_show_page_has_back_link(): void
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);

        $user = User::factory()->create();

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.users.show', $user));

        $response->assertStatus(200);
        $response->assertSee('Retour à la liste');
        $response->assertSee(route('admin.users.index'));
    }

    public function test_user_show_page_has_edit_button(): void
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);

        $user = User::factory()->create();

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.users.show', $user));

        $response->assertStatus(200);
        $response->assertSee('Modifier');
    }
}
