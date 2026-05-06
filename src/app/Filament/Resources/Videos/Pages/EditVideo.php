<?php

namespace App\Filament\Resources\Videos\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\Videos\VideoResource;
use App\Models\Video;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVideo extends EditRecord
{
    use TriggersRevalidation;

    protected static string $resource = VideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->withRevalidation(DeleteAction::make()),
        ];
    }

    protected function revalidationKey(): string
    {
        return Video::class;
    }
}
