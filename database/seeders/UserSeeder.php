<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Default Admin User
        User::create([
            'role_id' => Role::where('name', 'Admin')->first()->id,
            'name' => 'Example Admin',
            'username' => 'admin',
            'email' => fake()->unique()->freeEmail(),
            'password' => Hash::make('password'),
        ]);

        // Default Regular Users
        User::create([
            'role_id' => Role::where('name', 'User')->first()->id,
            'name' => 'Example User 1',
            'username' => 'ikanteri',
            'email' => fake()->unique()->freeEmail(),
            'password' => Hash::make('password'),
        ]);

        User::factory(15)->create();
    }
}
