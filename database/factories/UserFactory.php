<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'role_id' => Role::pluck('id')->random(),
            'name' => fake()->name(),
            'email' => fake()->unique()->freeEmail(),
            'password' => Hash::make(Config::get('app.default_password')),
        ];
    }
}
