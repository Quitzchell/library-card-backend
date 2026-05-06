<?php

namespace App\Filament\Resources\Videos\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\Videos\VideoResource;
use App\Models\Video;
use Filament\Resources\Pages\CreateRecord;

class CreateVideo extends CreateRecord
{
    use TriggersRevalidation;

    protected static string $resource = VideoResource::class;

    protected function revalidationKey(): string
    {
        return Video::class;
    }
}
