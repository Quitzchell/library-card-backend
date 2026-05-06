<?php

namespace Database\Seeders;

use App\Models\Music;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusicSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Music::factory()->count(6)->create();

        Music::factory()->unreleased()->create();
    }
}