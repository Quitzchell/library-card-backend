<?php

namespace App\Filament\Resources\TeamMembers\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\TeamMembers\TeamMemberResource;
use App\Models\TeamMember;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTeamMember extends EditRecord
{
    use TriggersRevalidation;

    protected static string $resource = TeamMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->withRevalidation(DeleteAction::make()),
        ];
    }

    protected function revalidationKey(): string
    {
        return TeamMember::class;
    }
}
