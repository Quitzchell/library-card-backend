<?php

namespace App\Filament\Resources\Music\Schemas;

use App\Enums\Platform;
use App\Enums\PlatformType;
use App\Filament\Forms\Components\OptimizedImageUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class MusicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Release Information')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Title')
                                    ->required(),
                                DatePicker::make('release_date')
                                    ->label('Release Date')
                                    ->required(),
                                OptimizedImageUpload::make('cover_image')
                                    ->directory('music')
                                    ->columnSpanFull(),
                            ])
                            ->columns(),
                        Tab::make('Platforms')
                            ->schema([
                                Repeater::make('platforms')
                                    ->hiddenLabel()
                                    ->collapsed()
                                    ->relationship()
                                    ->orderColumn()
                                    ->defaultItems(0)
                                    ->schema([
                                        Select::make('platform_type')
                                            ->label('Type')
                                            ->options(fn (): array => collect(PlatformType::cases())
                                                ->reject(fn (PlatformType $type) => $type === PlatformType::SocialAccount)
                                                ->mapWithKeys(fn (PlatformType $type) => [$type->value => $type->label()])
                                                ->all())
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(fn (Set $set) => $set('platform', null)),
                                        Select::make('platform')
                                            ->label('Name')
                                            ->options(fn (Get $get): array => ($type = PlatformType::tryFrom($get('platform_type') ?? ''))
                                                ? Platform::optionsFor($type)
                                                : [])
                                            ->required()
                                            ->disabled(fn (Get $get): bool => blank($get('platform_type'))),
                                        TextInput::make('url')->url()->required(),
                                        TextInput::make('label')
                                            ->visible(fn (Get $get): bool => $get('platform_type') === PlatformType::MusicStore->value),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => filled($state['platform'] ?? null)
                                        ? Platform::from($state['platform'])->label()
                                        : null),
                            ]),
                    ]),
            ])->columns(1);
    }
}
