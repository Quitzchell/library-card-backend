<?php

namespace App\Filament\Resources\Venues\Tables;

use App\Models\Venue;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class VenuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('city')
                    ->label('City')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('country')
                    ->label('Country')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('city')
                    ->searchable()
                    ->options(fn (): array => Venue::query()
                        ->whereNotNull('city')
                        ->distinct()
                        ->orderBy('city')
                        ->pluck('city', 'city')
                        ->all()),
                SelectFilter::make('country')
                    ->searchable()
                    ->options(fn (): array => Venue::query()
                        ->whereNotNull('country')
                        ->distinct()
                        ->orderBy('country')
                        ->pluck('country', 'country')
                        ->all()),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
