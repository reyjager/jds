<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetCmsPassword extends Command
{
    protected $signature = 'cms:password {login : Username or email address}';

    protected $description = 'Reset the password for a CMS user';

    public function handle(): int
    {
        $user = User::query()
            ->where('username', $this->argument('login'))
            ->orWhere('email', $this->argument('login'))
            ->first();

        if ($user === null) {
            $this->error('No CMS user matched that username or email.');
            return self::FAILURE;
        }

        $password = $this->secret('New password');
        $confirmation = $this->secret('Confirm password');

        if (! is_string($password) || $password !== $confirmation || strlen($password) < 12) {
            $this->error('Passwords must match and be at least 12 characters.');
            return self::FAILURE;
        }

        $user->forceFill(['password' => Hash::make($password)])->save();
        $this->info("Password reset for {$user->username}.");

        return self::SUCCESS;
    }
}
