<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => config('services.admin.name'),
            'email' => config('services.admin.email'),
            'password' => config('services.admin.password'),
            'role' => Role::SuperAdmin,
        ]);
    }
}
