<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Venue::factory()->count(20)->create();
    }
}