<?php

namespace App\Filament\Resources\SocialAccounts\Schemas;

use App\Enums\Platform;
use App\Enums\PlatformType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SocialAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Social account')
                    ->schema([
                        Select::make('platform')
                            ->options(Platform::optionsFor(PlatformType::SocialAccount))
                            ->required(),
                        TextInput::make('url')
                            ->url()
                            ->required(),
                        Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columnSpanFull()
                    ->columns(2),
            ]);
    }
}
