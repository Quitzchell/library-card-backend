<?php

namespace App\Filament\Resources\SocialAccounts\Tables;

use App\Enums\Platform;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SocialAccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort')
            ->defaultSort('sort')
            ->columns([
                TextColumn::make('platform')
                    ->label('Platform')
                    ->formatStateUsing(fn (Platform $state): string => $state->label()),
                TextColumn::make('url')
                    ->label('URL')
                    ->url(fn ($record): string => $record->url, true)
                    ->limit(50)
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
