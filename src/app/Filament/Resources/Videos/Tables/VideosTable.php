<?php

namespace App\Filament\Resources\Videos\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VideosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort')
            ->defaultSort('sort')
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
