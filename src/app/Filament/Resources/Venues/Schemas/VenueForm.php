<?php

namespace App\Filament\Resources\Venues\Schemas;

use App\Models\Venue;
use App\Rules\CaseInsensitiveUnique;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class VenueForm
{
    public static function configure(Schema $schema): Schema
    {
        $rule = fn (array $scopedColumns) => fn (Get $get, ?Model $record) => new CaseInsensitiveUnique(
            model: Venue::class,
            columns: collect($scopedColumns)
                ->mapWithKeys(fn (string $column) => [$column => (string) $get($column)])
                ->all(),
            ignore: $record,
            message: 'A venue with this name, city, and country already exists.',
        );

        return $schema
            ->components([
                Section::make('Venue Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->rules([$rule(['city', 'country'])])
                            ->columnSpanFull(),
                        TextInput::make('city')
                            ->label('City')
                            ->required()
                            ->rules([$rule(['name', 'country'])]),
                        TextInput::make('country')
                            ->label('Country')
                            ->required()
                            ->maxLength(3)
                            ->hint('Use an ISO country code (e.g. NL, USA)')
                            ->placeholder('NL')
                            ->rules([$rule(['name', 'city'])]),
                    ])
                    ->columnSpanFull()
                    ->columns(),
            ]);
    }
}
