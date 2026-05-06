<?php

namespace App\Filament\Resources\Venues\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\Venues\VenueResource;
use App\Models\Venue;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVenue extends EditRecord
{
    use TriggersRevalidation;

    protected static string $resource = VenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->withRevalidation(DeleteAction::make()),
        ];
    }

    protected function revalidationKey(): string
    {
        return Venue::class;
    }
}
