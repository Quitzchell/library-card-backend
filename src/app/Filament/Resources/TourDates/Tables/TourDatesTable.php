<?php

namespace App\Filament\Resources\TourDates\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TourDatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'DESC')
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('venue.name')
                    ->label('Venue')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('sold_out')
                    ->label('Sold Out')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('sold_out'),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
