<?php

namespace App\Console\Commands\Admin;

use App\Domain\Identity\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user
                            {--name= : The name of the admin user}
                            {--email= : The email of the admin user}
                            {--password= : The password for the admin user}
                            {--interactive : Force interactive mode even with options}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user for bootstrapping the application';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🔐 Admin User Creation');
        $this->line('');

        // Determine if we should use interactive mode
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');
        $hasAllOptions = is_string($name) && is_string($email) && is_string($password);
        $isInteractive = $this->option('interactive') === true || ! $hasAllOptions;

        if ($isInteractive) {
            return $this->interactiveMode();
        }

        /** @var string $name */
        /** @var string $email */
        /** @var string $password */
        return $this->createUser($name, $email, $password);
    }

    /**
     * Interactive mode for creating admin user.
     */
    private function interactiveMode(): int
    {
        $this->info('Please provide the following information:');
        $this->line('');

        // Get name
        $name = $this->getNameInput();

        // Get email
        $email = $this->getEmailInput();

        // Get password
        $password = $this->getPasswordInput();

        // Show summary and confirm
        $this->line('');
        $this->info('📋 Summary:');
        $this->line("  Name: {$name}");
        $this->line("  Email: {$email}");
        $this->line('');

        if (! $this->confirm('Create admin user with these details?')) {
            $this->info('Operation cancelled.');

            return self::FAILURE;
        }

        return $this->createUser($name, $email, $password);
    }

    /**
     * Get and validate name input.
     */
    private function getNameInput(): string
    {
        while (true) {
            /** @var string|null $name */
            $name = $this->ask('Admin name');

            if ($name === null || $name === '') {
                $this->error('Name cannot be empty.');

                continue;
            }

            if (strlen($name) < 2) {
                $this->error('Name must be at least 2 characters.');

                continue;
            }

            if (strlen($name) > 255) {
                $this->error('Name must not exceed 255 characters.');

                continue;
            }

            return $name;
        }
    }

    /**
     * Get and validate email input.
     */
    private function getEmailInput(): string
    {
        while (true) {
            /** @var string|null $email */
            $email = $this->ask('Admin email');

            // Validate email format (without DNS check for local development)
            $validator = Validator::make(['email' => $email], [
                'email' => 'required|email:rfc',
            ]);

            if ($validator->fails()) {
                $this->error($validator->errors()->first('email'));

                continue;
            }

            if ($email === null) {
                continue;
            }

            // Check if email already exists
            if (User::query()->where('email', $email)->toBase()->exists()) {
                $this->error("A user with email {$email} already exists.");

                continue;
            }

            return $email;
        }
    }

    /**
     * Get and validate password input.
     */
    private function getPasswordInput(): string
    {
        while (true) {
            /** @var string|null $password */
            $password = $this->secret('Admin password (min. 8 characters)');

            if ($password === null || $password === '') {
                $this->error('Password cannot be empty.');

                continue;
            }

            if (strlen($password) < 8) {
                $this->error('Password must be at least 8 characters.');

                continue;
            }

            $confirm = $this->secret('Confirm password');

            if ($password !== $confirm) {
                $this->error('Passwords do not match.');

                continue;
            }

            return $password;
        }
    }

    /**
     * Create the admin user.
     */
    private function createUser(string $name, string $email, string $password): int
    {
        try {
            // Create the admin user
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            // Assign admin role
            $user->assignRole('admin');
            $this->info('✓ Admin role assigned');

            $this->line('');
            $this->info('✅ Admin user created successfully!');
            $this->line("   Name: {$name}");
            $this->line("   Email: {$email}");
            $this->line('   Role: admin');

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('An error occurred while creating the admin user: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}
