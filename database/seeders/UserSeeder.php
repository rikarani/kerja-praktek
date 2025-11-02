<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Default Admin User
        User::create([
            'role_id' => Role::where('name', 'admin')->first()->id,
            'name' => 'Example Admin',
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make(Config::get('app.default_password')),
        ]);

        // Default Regular Users
        User::create([
            'role_id' => Role::where('name', 'user')->first()->id,
            'name' => 'Example User 1',
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make(Config::get('app.default_password')),
        ]);

        User::factory(15)->create();
    }
}
