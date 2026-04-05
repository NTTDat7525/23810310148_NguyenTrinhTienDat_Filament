#!/usr/bin/env php
<?php

require __DIR__ . '/bootstrap/app.php';

$app = \Illuminate\Foundation\Application::getInstance();
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

// Run migrations
echo "Running migrations...\n";
$kernel->call('migrate', ['--force' => true]);

// Seed the database
echo "\nSeeding database...\n";
$kernel->call('db:seed', ['--class' => 'AdminUserSeeder', '--force' => true]);

echo "\n✅ Setup complete!\n";
echo "Access Filament at: http://localhost:8000/admin\n";
echo "Email: admin@filament.test\n";
echo "Password: password\n";
