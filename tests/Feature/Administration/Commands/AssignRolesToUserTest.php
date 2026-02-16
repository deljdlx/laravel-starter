<?php

namespace Tests\Feature\Administration\Commands;

use App\Domain\Identity\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AssignRolesToUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles for testing
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'user']);
    }

    /**
     * Test assigning role to user in interactive mode.
     */
    public function test_assign_role_in_interactive_mode(): void
    {
        $user = User::factory()->create(['email' => 'user@example.com', 'name' => 'Test User']);

        /** @phpstan-ignore-next-line */
        $this->artisan('app:assign-roles-to-user')
            ->expectsQuestion('Search user by email or name', 'user@example.com')
            ->expectsQuestion('Select roles (comma-separated numbers, e.g., 1,3)', '1')
            ->expectsConfirmation('Assign these roles to the user?', 'yes')
            ->assertSuccessful();

        /** @var User $freshUser */
        $freshUser = $user->fresh();
        static::assertTrue($freshUser->hasRole('admin'));
    }

    /**
     * Test assigning multiple roles to user.
     */
    public function test_assign_multiple_roles_to_user(): void
    {
        $user = User::factory()->create(['email' => 'user@example.com', 'name' => 'Test User']);

        /** @phpstan-ignore-next-line */
        $this->artisan('app:assign-roles-to-user')
            ->expectsQuestion('Search user by email or name', 'user@example.com')
            ->expectsQuestion('Select roles (comma-separated numbers, e.g., 1,3)', '1,2')
            ->expectsConfirmation('Assign these roles to the user?', 'yes')
            ->assertSuccessful();

        /** @var User $freshUser */
        $freshUser = $user->fresh();
        static::assertTrue($freshUser->hasRole('admin'));
        static::assertTrue($freshUser->hasRole('moderator'));
    }

    /**
     * Test that role assignment can be cancelled.
     */
    public function test_role_assignment_can_be_cancelled(): void
    {
        $user = User::factory()->create(['email' => 'user@example.com', 'name' => 'Test User']);

        /** @phpstan-ignore-next-line */
        $this->artisan('app:assign-roles-to-user')
            ->expectsQuestion('Search user by email or name', 'user@example.com')
            ->expectsQuestion('Select roles (comma-separated numbers, e.g., 1,3)', '1')
            ->expectsConfirmation('Assign these roles to the user?', 'no')
            ->assertFailed();

        /** @var User $freshUser */
        $freshUser = $user->fresh();
        static::assertFalse($freshUser->hasRole('admin'));
    }

    /**
     * Test that existing roles are replaced (sync, not attach).
     */
    public function test_roles_are_synced_replacing_existing_roles(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user', 'moderator');

        /** @phpstan-ignore-next-line */
        $this->artisan('app:assign-roles-to-user')
            ->expectsQuestion('Search user by email or name', $user->name)
            ->expectsQuestion('Select roles (comma-separated numbers, e.g., 1,3)', '1')
            ->expectsConfirmation('Assign these roles to the user?', 'yes')
            ->assertSuccessful();

        /** @var User $freshUser */
        $freshUser = $user->fresh();
        static::assertTrue($freshUser->hasRole('admin'));
        static::assertFalse($freshUser->hasRole('user'));
        static::assertFalse($freshUser->hasRole('moderator'));
    }

    /**
     * Test that user search by name works.
     */
    public function test_user_search_by_name(): void
    {
        $user = User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);

        /** @phpstan-ignore-next-line */
        $this->artisan('app:assign-roles-to-user')
            ->expectsQuestion('Search user by email or name', 'John')
            ->expectsQuestion('Select roles (comma-separated numbers, e.g., 1,3)', '1')
            ->expectsConfirmation('Assign these roles to the user?', 'yes')
            ->assertSuccessful();

        /** @var User $freshUser */
        $freshUser = $user->fresh();
        static::assertTrue($freshUser->hasRole('admin'));
    }
}
