<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateUserPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'chhaynatah@gmail.com')->first();

        if ($user) {
            $user->password = Hash::make('Chhayna79a'); // Change to your desired password
            $user->save();

            $this->command->info('Password updated successfully for: ' . $user->email);
        } else {
            $this->command->warn('User not found.');
        }
    }
}
