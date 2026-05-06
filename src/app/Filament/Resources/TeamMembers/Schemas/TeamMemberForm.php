<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use App\Enums\Team;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Team Member')
                    ->schema([
                        Select::make('team')
                            ->options(Team::options())
                            ->required(),
                        TextInput::make('region')
                            ->required(),
                        TextInput::make('first_name')
                            ->required(),
                        TextInput::make('last_name')
                            ->required(),
                        TextInput::make('organization'),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(2),
            ]);
    }
}
