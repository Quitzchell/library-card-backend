<?php

namespace App\Enums;

enum PlatformType: string
{
    case StreamingService = 'streaming_service';
    case MusicStore = 'music_store';
    case SocialAccount = 'social_account';

    public function label(): string
    {
        return match ($this) {
            self::StreamingService => 'Streaming service',
            self::MusicStore => 'Music store',
            self::SocialAccount => 'Social account',
        };
    }
}
