<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Collection::make(['Admin', 'User'])->each(fn (string $role) => Role::create(['name' => $role]));
    }
}
