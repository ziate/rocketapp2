<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@rocket.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Employee
        User::updateOrCreate(
            ['email' => 'employee@rocket.com'],
            [
                'name' => 'Employee User',
                'password' => Hash::make('password'),
                'role' => 'employee',
            ]
        );
    }
}
