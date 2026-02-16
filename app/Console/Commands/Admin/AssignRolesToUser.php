<?php

namespace App\Console\Commands\Admin;

use App\Domain\Identity\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class AssignRolesToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-roles-to-user
                            {--user= : The email or ID of the user}
                            {--roles=* : The roles to assign (comma-separated or multiple)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign one or multiple roles to a user interactively';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('👥 Assign Roles to User');
        $this->line('');

        // Get user
        $user = $this->getUser();
        if ($user === null) {
            return self::FAILURE;
        }

        // Get roles
        $roles = $this->getRoles();
        if ($roles === []) {
            $this->error('No roles selected.');

            return self::FAILURE;
        }

        // Show summary
        $this->displaySummary($user, $roles);

        // Confirm and assign
        if (! $this->confirm('Assign these roles to the user?')) {
            $this->info('Operation cancelled.');

            return self::FAILURE;
        }

        return $this->assignRoles($user, $roles);
    }

    /**
     * Get user from input or interactive prompt.
     */
    private function getUser(): ?User
    {
        $userInput = $this->option('user');

        if (is_string($userInput) && $userInput !== '') {
            return $this->findUser($userInput);
        }

        while (true) {
            /** @var string|null $search */
            $search = $this->ask('Search user by email or name');

            if ($search === null || $search === '') {
                $this->error('Search cannot be empty.');

                continue;
            }

            /** @phpstan-ignore-next-line */
            $users = User::query()->where('email', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->limit(10)
                ->get();

            if ($users->isEmpty()) {
                $this->error('No users found.');

                continue;
            }

            if ($users->count() === 1) {
                /** @var User $firstUser */
                $firstUser = $users->first();

                return $firstUser;
            }

            // Multiple users found, let user choose
            $this->line('');
            $this->info('Multiple users found:');
            $choices = $users->mapWithKeys(function (User $user, int $index) {
                $this->line('  ['.($index + 1)."] {$user->name} ({$user->email})");

                return [$index => $user->id];
            })->toArray();

            /** @var string|null $selected */
            $selected = $this->ask('Select user number', '1');
            $index = ((int) ($selected ?? '1')) - 1;

            if (! isset($choices[$index])) {
                $this->error('Invalid selection.');

                continue;
            }

            /** @var User|null $selectedUser */
            $selectedUser = User::find($choices[$index]);

            return $selectedUser;
        }
    }

    /**
     * Find a user by email or ID.
     */
    private function findUser(string $input): ?User
    {
        $user = User::where('email', $input)->first();

        if ($user === null) {
            $user = User::find($input);
        }

        if ($user === null) {
            $this->error("User not found: {$input}");

            return null;
        }

        return $user;
    }

    /**
     * Get roles from input or interactive selection.
     *
     * @return array<int, string>
     */
    private function getRoles(): array
    {
        /** @var array<int, string> $rolesOption */
        $rolesOption = $this->option('roles');

        if ($rolesOption !== []) {
            return $this->findRoles($rolesOption);
        }

        $allRoles = Role::all();

        if ($allRoles->isEmpty()) {
            $this->error('No roles available.');

            return [];
        }

        $this->line('');
        $this->info('Available roles:');
        $rolesArray = $allRoles->mapWithKeys(function (Role $role, int $index) {
            $this->line('  ['.($index + 1)."] {$role->name}");

            return [$index => $role->name];
        })->toArray();

        /** @var string|null $selections */
        $selections = $this->ask('Select roles (comma-separated numbers, e.g., 1,3)');

        if ($selections === null || $selections === '') {
            $this->error('No roles selected.');

            return [];
        }

        $selectedIndexes = array_map('trim', explode(',', $selections));
        /** @var array<int, string> $selectedRoles */
        $selectedRoles = [];

        foreach ($selectedIndexes as $index) {
            $idx = (int) $index - 1;
            if (isset($rolesArray[$idx])) {
                /** @var string $roleName */
                $roleName = $rolesArray[$idx];
                $selectedRoles[] = $roleName;
            } else {
                $this->warn("Invalid selection: {$index}");
            }
        }

        return $selectedRoles;
    }

    /**
     * Find roles by name.
     *
     * @param  array<int, string>  $roleNames
     * @return array<int, string>
     */
    private function findRoles(array $roleNames): array
    {
        /** @var array<int, string> $roles */
        $roles = [];

        foreach ($roleNames as $name) {
            $role = Role::where('name', $name)->first();
            if ($role !== null) {
                $roles[] = $role->name;
            } else {
                $this->warn("Role not found: {$name}");
            }
        }

        return $roles;
    }

    /**
     * Display summary of changes.
     *
     * @param  array<int, string>  $roles
     */
    private function displaySummary(User $user, array $roles): void
    {
        $this->line('');
        $this->info('📋 Summary:');
        $this->line("  User: {$user->name} ({$user->email})");
        $this->line('  Current roles: '.(count($user->getRoleNames()) > 0 ? implode(', ', $user->getRoleNames()->toArray()) : 'None'));
        $this->line('  Roles to assign: '.implode(', ', $roles));
        $this->line('');
    }

    /**
     * Assign roles to user.
     *
     * @param  array<int, string>  $roles
     */
    private function assignRoles(User $user, array $roles): int
    {
        try {
            // Sync roles (replace all existing roles)
            $user->syncRoles($roles);

            $this->line('');
            $this->info('✅ Roles assigned successfully!');
            $this->line("   User: {$user->name}");
            $this->line('   Roles: '.implode(', ', $user->getRoleNames()->toArray()));

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('An error occurred: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}
