<?php

namespace App\Filament\Resources\Music\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\Music\MusicResource;
use App\Models\Music;
use Filament\Resources\Pages\CreateRecord;

class CreateMusic extends CreateRecord
{
    use TriggersRevalidation;

    protected static string $resource = MusicResource::class;

    protected function revalidationKey(): string
    {
        return Music::class;
    }
}
