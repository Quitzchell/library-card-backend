<?php

namespace App\Filament\Resources\TeamMembers\Pages;

use App\Enums\Team;
use App\Filament\Resources\TeamMembers\TeamMemberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTeamMembers extends ListRecords
{
    protected static string $resource = TeamMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        foreach (Team::cases() as $team) {
            $tabs[$team->value] = Tab::make($team->label())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('team', $team->value));
        }

        return $tabs;
    }
}
