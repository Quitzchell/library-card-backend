<?php

namespace App\Filament\Resources\Videos\Schemas;

use App\Enums\VideoType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Video Information')
                    ->schema([
                        TextInput::make('title')
                            ->columnSpanFull()
                            ->required(),
                        TextInput::make('video_id')
                            ->label('YouTube video ID or URL')
                            ->helperText('Paste a YouTube URL - the 11-character ID is extracted on save.')
                            ->required(),
                        Select::make('category')
                            ->options(VideoType::options())
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(),
            ]);
    }
}
