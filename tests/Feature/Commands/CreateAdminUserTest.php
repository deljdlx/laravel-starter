<?php

namespace Tests\Feature\Commands;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateAdminUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'admin']);
    }

    /**
     * Test creating an admin user with all required options succeeds.
     */
    public function test_create_admin_user_succeeds_with_all_options(): void
    {
        /** @phpstan-ignore-next-line */
        $this->artisan('app:create-admin-user')
            ->expectsQuestion('Admin name', 'Test Admin')
            ->expectsQuestion('Admin email', 'admin@test.com')
            ->expectsQuestion('Admin password (min. 8 characters)', 'SecurePassword123')
            ->expectsQuestion('Confirm password', 'SecurePassword123')
            ->expectsConfirmation('Create admin user with these details?', 'yes')
            ->assertSuccessful();

        static::assertDatabaseHas('users', [
            'email' => 'admin@test.com',
            'name' => 'Test Admin',
        ]);

        /** @var User $user */
        $user = User::where('email', 'admin@test.com')->first();
        static::assertTrue($user->hasRole('admin'));
    }

    /**
     * Test that duplicate email is rejected.
     */
    public function test_duplicate_email_is_rejected(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        /** @phpstan-ignore-next-line */
        $this->artisan('app:create-admin-user')
            ->expectsQuestion('Admin name', 'New Admin')
            ->expectsQuestion('Admin email', 'existing@example.com')
            ->expectsOutput('A user with email existing@example.com already exists.')
            ->expectsQuestion('Admin email', 'newadmin@example.com')
            ->expectsQuestion('Admin password (min. 8 characters)', 'SecurePassword123')
            ->expectsQuestion('Confirm password', 'SecurePassword123')
            ->expectsConfirmation('Create admin user with these details?', 'yes')
            ->assertSuccessful();
    }

    /**
     * Test that password mismatch is caught.
     */
    public function test_password_mismatch_is_rejected(): void
    {
        /** @phpstan-ignore-next-line */
        $this->artisan('app:create-admin-user')
            ->expectsQuestion('Admin name', 'Test Admin')
            ->expectsQuestion('Admin email', 'admin@test.com')
            ->expectsQuestion('Admin password (min. 8 characters)', 'SecurePassword123')
            ->expectsQuestion('Confirm password', 'DifferentPassword456')
            ->expectsOutput('Passwords do not match.')
            ->expectsQuestion('Admin password (min. 8 characters)', 'SecurePassword123')
            ->expectsQuestion('Confirm password', 'SecurePassword123')
            ->expectsConfirmation('Create admin user with these details?', 'yes')
            ->assertSuccessful();
    }

    /**
     * Test that user creation can be cancelled.
     */
    public function test_user_creation_can_be_cancelled(): void
    {
        /** @phpstan-ignore-next-line */
        $this->artisan('app:create-admin-user')
            ->expectsQuestion('Admin name', 'Test Admin')
            ->expectsQuestion('Admin email', 'admin@test.com')
            ->expectsQuestion('Admin password (min. 8 characters)', 'SecurePassword123')
            ->expectsQuestion('Confirm password', 'SecurePassword123')
            ->expectsConfirmation('Create admin user with these details?', 'no')
            ->assertFailed();

        static::assertDatabaseMissing('users', [
            'email' => 'admin@test.com',
        ]);
    }

    /**
     * Test that admin user is created with admin role.
     */
    public function test_admin_role_is_correctly_assigned(): void
    {
        /** @phpstan-ignore-next-line */
        $this->artisan('app:create-admin-user')
            ->expectsQuestion('Admin name', 'Admin User')
            ->expectsQuestion('Admin email', 'adminrole@test.com')
            ->expectsQuestion('Admin password (min. 8 characters)', 'SecurePassword123')
            ->expectsQuestion('Confirm password', 'SecurePassword123')
            ->expectsConfirmation('Create admin user with these details?', 'yes')
            ->assertSuccessful();

        /** @var User $user */
        $user = User::where('email', 'adminrole@test.com')->first();
        static::assertTrue($user->hasRole('admin'));
        static::assertCount(1, $user->getRoleNames());
    }
}
