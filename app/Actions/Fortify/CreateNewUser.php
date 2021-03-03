<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\Assistant;
use App\Models\Customer;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'role' => ['required'],
        ])->validate();

        $role = $input['role'];

        // * Roles Id
        // 1 => admin
        // 2 => manager
        // 3 => assistant
        // 4 => customer

        if ($role == 0) {
            return Admin::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        } else if ($role == 1) {
            return Manager::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        } else if ($role == 2) {
            return Assistant::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'manager_id' => $input['manager_id'],
                'password' => Hash::make($input['password']),
            ]);
        } else {
            return Customer::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'assistant_id' => $input['assistant_id'],
                'password' => Hash::make($input['password']),
            ]);
        }

        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        // ]);
    }
}
