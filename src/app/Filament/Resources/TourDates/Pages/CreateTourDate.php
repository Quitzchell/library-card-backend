<?php

namespace App\Filament\Resources\TourDates\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\TourDates\TourDateResource;
use App\Models\TourDate;
use Filament\Resources\Pages\CreateRecord;

class CreateTourDate extends CreateRecord
{
    use TriggersRevalidation;

    protected static string $resource = TourDateResource::class;

    protected function revalidationKey(): string
    {
        return TourDate::class;
    }
}
