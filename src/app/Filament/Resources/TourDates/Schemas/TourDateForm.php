<?php

namespace App\Filament\Resources\TourDates\Schemas;

use App\Filament\Resources\Venues\Schemas\VenueForm;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TourDateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Tour Date')
                    ->schema([
                        Select::make('venue_id')
                            ->label('Venue')
                            ->relationship('venue', 'name')
                            ->searchable()
                            ->preload()
                            ->optionsLimit(5)
                            ->createOptionForm(fn (Schema $schema) => VenueForm::configure($schema))
                            ->required()
                            ->columnSpanFull(),
                        DatePicker::make('date')
                            ->label('Date')
                            ->native(false)
                            ->displayFormat('d-m-Y')
                            ->required(),
                        TextInput::make('ticket_url')
                            ->label('Ticket URL')
                            ->url()
                            ->maxLength(255),
                        Toggle::make('sold_out')
                            ->label('Sold out')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->columns(),
            ]);
    }
}
