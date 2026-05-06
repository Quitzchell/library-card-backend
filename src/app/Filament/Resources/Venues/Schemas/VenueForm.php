<?php

namespace App\Filament\Resources\Venues\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VenueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Venue Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('city')
                            ->label('City')
                            ->required(),
                        TextInput::make('country')
                            ->label('Country')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(),
            ]);
    }
}
