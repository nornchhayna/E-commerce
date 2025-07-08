<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin1@example.com',
            'password' => Hash::make('Chhayna79a'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Manager Admin',
            'email' => 'admin2@example.com',
            'password' => Hash::make('Chhayna79a'),
            'role' => 'admin',
        ]);
    }
}
