<?php

use App\Models\Music;
use App\Models\SocialAccount;
use App\Models\TeamMember;
use App\Models\TourDate;
use App\Models\Venue;
use App\Models\Video;
use App\Settings\BiographySettings;

return [
    'url' => env('REVALIDATION_URL'),
    'secret' => env('REVALIDATION_SECRET'),

    // Maps a model (or settings) class to the public Next.js paths whose
    // ISR cache + Upstash entries should be refreshed when the record changes.
    // Mirror this map in the frontend's revalidate route handler.
    'paths' => [
        Music::class => ['/', '/music'],
        SocialAccount::class => ['/', '/about'],
        TeamMember::class => ['/', '/about'],
        TourDate::class => ['/', '/tour'],
        Venue::class => ['/', '/tour'],
        Video::class => ['/', '/video'],
        BiographySettings::class => ['/', '/about'],
    ],
];
