<?php

namespace Database\Seeders;

use App\Models\TourDate;
use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourDateSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $venueIds = Venue::pluck('id');

        TourDate::factory()
            ->count(20)
            ->past()
            ->state(fn () => ['venue_id' => $venueIds->random()])
            ->create();

        TourDate::factory()
            ->count(8)
            ->state(fn () => ['venue_id' => $venueIds->random()])
            ->create();

        TourDate::factory()
            ->count(2)
            ->soldOut()
            ->state(fn () => ['venue_id' => $venueIds->random()])
            ->create();
    }
}