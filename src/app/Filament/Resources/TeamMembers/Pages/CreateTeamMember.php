<?php

namespace App\Filament\Resources\TeamMembers\Pages;

use App\Filament\Concerns\TriggersRevalidation;
use App\Filament\Resources\TeamMembers\TeamMemberResource;
use App\Models\TeamMember;
use Filament\Resources\Pages\CreateRecord;

class CreateTeamMember extends CreateRecord
{
    use TriggersRevalidation;

    protected static string $resource = TeamMemberResource::class;

    protected function revalidationKey(): string
    {
        return TeamMember::class;
    }
}
