<?php

namespace App\Filament\Resources\TourDates\Pages;

use App\Filament\Resources\TourDates\TourDateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTourDates extends ListRecords
{
    protected static string $resource = TourDateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
