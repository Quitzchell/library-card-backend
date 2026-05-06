<?php

namespace App\Filament\Resources\TourDates\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\TourDates\TourDateResource;
use App\Models\TourDate;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTourDate extends EditRecord
{
    use TriggersRevalidation;

    protected static string $resource = TourDateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->withRevalidation(DeleteAction::make()),
        ];
    }

    protected function revalidationKey(): string
    {
        return TourDate::class;
    }
}
