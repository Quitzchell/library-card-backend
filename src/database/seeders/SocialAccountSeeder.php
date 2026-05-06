<?php

namespace Database\Seeders;

use App\Enums\Platform;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialAccountSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            Platform::Instagram,
            Platform::Facebook,
            Platform::SoundCloud,
            Platform::YouTube,
        ];

        $rows = [];

        foreach ($platforms as $sort => $platform) {
            $rows[] = [
                'platform' => $platform->value,
                'url' => fake()->url(),
                'is_active' => true,
                'sort' => $sort + 1,
            ];
        }

        DB::table('social_accounts')->insert($rows);
    }
}