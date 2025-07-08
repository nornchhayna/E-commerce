<?php

namespace App\Console\Commands;

use App\Models\User;

use Illuminate\Console\Command;

class MakeUserSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:superadmin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a user a super admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        $user->is_superadmin = true;
        $user->save();

        $this->info("User {$user->name} is now a super admin.");
    }
}
