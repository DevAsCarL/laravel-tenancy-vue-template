<?php

namespace Database\Seeders\System;

use App\Enums\Role;
use App\Models\System\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        User::factory()
            ->afterCreating(function (User $user) {
                $user->assignRole(Role::ADMIN->value);
            })
            ->create([
                'email' => \env('SEED_ADMIN_EMAIL'),
            ]);
    }
}
