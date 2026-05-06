<?php

namespace Database\Seeders;

use App\Enums\Platform;
use App\Models\Music;
use App\Models\MusicPlatform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusicPlatformSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $streamingPlatforms = [
            Platform::Spotify,
            Platform::Bandcamp,
            Platform::Tidal,
            Platform::Deezer,
            Platform::AppleMusic,
            Platform::YoutubeMusic,
            Platform::AmazonMusic,
        ];

        Music::all()->each(function (Music $music) use ($streamingPlatforms): void {
            foreach ($streamingPlatforms as $sort => $platform) {
                MusicPlatform::create([
                    'music_id' => $music->id,
                    'platform_type' => $platform->type(),
                    'platform' => $platform,
                    'url' => fake()->url(),
                    'sort' => $sort + 1,
                ]);
            }
        });
    }
}