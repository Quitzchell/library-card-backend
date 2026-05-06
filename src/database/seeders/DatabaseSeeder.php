<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            MusicSeeder::class,
            MusicPlatformSeeder::class,
            VenueSeeder::class,
            TourDateSeeder::class,
            VideoSeeder::class,
            TeamMemberSeeder::class,
            SocialAccountSeeder::class,
        ]);
    }
}
