<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Video::factory()->count(8)->create();
    }
}