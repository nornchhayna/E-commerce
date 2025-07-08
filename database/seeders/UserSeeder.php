<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a super admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'superchhayna@gmail.com',
            'password' => Hash::make('Chhayna79a'), // Use a secure password
            'role' => 'super_admin', // Make sure this matches your role definition
        ]);
    }
}