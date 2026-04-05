<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetupFilament extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament:setup {--email=admin@filament.test} {--password=password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Filament with database and admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate', ['--force' => true]);

        $email = $this->option('email');
        $password = $this->option('password');

        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin User',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );

        $this->info('✅ Filament setup complete!');
        $this->info('Admin user created:');
        $this->info("  Email: {$email}");
        $this->info("  Password: {$password}");
        $this->info("\nAccess Filament at: http://localhost:8000/admin");
    }
}
