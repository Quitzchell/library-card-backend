<?php

namespace App\Filament\Resources\TourDates;

use App\Filament\Resources\TourDates\Pages\CreateTourDate;
use App\Filament\Resources\TourDates\Pages\EditTourDate;
use App\Filament\Resources\TourDates\Pages\ListTourDates;
use App\Filament\Resources\TourDates\Schemas\TourDateForm;
use App\Filament\Resources\TourDates\Tables\TourDatesTable;
use App\Models\TourDate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TourDateResource extends Resource
{
    protected static ?string $model = TourDate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static string|\UnitEnum|null $navigationGroup = 'Tour';

    protected static ?string $recordTitleAttribute = 'venue.name';

    public static function form(Schema $schema): Schema
    {
        return TourDateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TourDatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTourDates::route('/'),
            'create' => CreateTourDate::route('/create'),
            'edit' => EditTourDate::route('/{record}/edit'),
        ];
    }
}
