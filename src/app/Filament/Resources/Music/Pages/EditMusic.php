<?php

namespace App\Filament\Resources\Music\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\Music\MusicResource;
use App\Models\Music;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMusic extends EditRecord
{
    use TriggersRevalidation;

    protected static string $resource = MusicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->withRevalidation(DeleteAction::make()),
        ];
    }

    protected function revalidationKey(): string
    {
        return Music::class;
    }
}
