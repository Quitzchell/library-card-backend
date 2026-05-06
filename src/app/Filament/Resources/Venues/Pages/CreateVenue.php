<?php

namespace App\Filament\Resources\Venues\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\Venues\VenueResource;
use App\Models\Venue;
use Filament\Resources\Pages\CreateRecord;

class CreateVenue extends CreateRecord
{
    use TriggersRevalidation;

    protected static string $resource = VenueResource::class;

    protected function revalidationKey(): string
    {
        return Venue::class;
    }
}
