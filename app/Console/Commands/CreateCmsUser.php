<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreateCmsUser extends Command
{
    protected $signature = 'cms:user';

    protected $description = 'Create an admin or editor CMS user';

    public function handle(): int
    {
        $name = $this->ask('Name');
        $username = $this->ask('Username');
        $email = $this->ask('Email');
        $role = $this->choice('Role', ['admin', 'editor'], 'editor');
        $password = $this->secret('Password');
        $passwordConfirmation = $this->secret('Confirm password');

        try {
            validator([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'role' => $role,
                'password' => $password,
                'password_confirmation' => $passwordConfirmation,
            ], [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'role' => ['required', Rule::in(['admin', 'editor'])],
                'password' => ['required', 'string', 'min:12', 'confirmed'],
            ])->validate();
        } catch (ValidationException $exception) {
            foreach ($exception->validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'password' => $password,
        ]);

        $this->info("CMS {$role} user created successfully.");

        return self::SUCCESS;
    }
}
