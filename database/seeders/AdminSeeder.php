<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create Super Admin
        User::firstOrCreate(
            ['email' => 'super_admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'store_name' => 'Main Store',
                'is_active' => true,
            ]
        );

        // Create Store Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Store Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'store_name' => 'Electronics Store',
                'is_active' => true,
            ]
        );

        // Create Customer
        User::firstOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'John Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'is_active' => true,
            ]
        );
    }
}
