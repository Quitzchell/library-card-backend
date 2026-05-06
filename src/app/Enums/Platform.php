<?php

namespace App\Enums;

enum Platform: string
{
    case Instagram = 'instagram';
    case Facebook = 'facebook';
    case SoundCloud = 'soundcloud';
    case YouTube = 'youtube';

    case Spotify = 'spotify';
    case AppleMusic = 'apple_music';
    case Deezer = 'deezer';
    case Bandcamp = 'bandcamp';

    case YoutubeMusic = 'youtube_music';
    case AmazonMusic = 'amazon_music';
    case Tidal = 'tidal';

    case AtEaseRecords = 'at_ease_records';

    public function label(): string
    {
        return match ($this) {
            self::Instagram => 'Instagram',
            self::Facebook => 'Facebook',
            self::SoundCloud => 'SoundCloud',
            self::YouTube => 'YouTube',
            self::Spotify => 'Spotify',
            self::AppleMusic => 'Apple Music',
            self::Deezer => 'Deezer',
            self::Bandcamp => 'Bandcamp',
            self::YoutubeMusic => 'YouTube Music',
            self::AmazonMusic => 'Amazon Music',
            self::Tidal => 'Tidal',
            self::AtEaseRecords => 'At Ease Records',
        };
    }

    /**
     * @return PlatformType[]
     */
    public function types(): array
    {
        return match ($this) {
            self::Instagram,
            self::Facebook,
            self::SoundCloud,
            self::YouTube => [PlatformType::SocialAccount],

            self::Spotify,
            self::AppleMusic,
            self::Deezer,
            self::Bandcamp => [PlatformType::StreamingService, PlatformType::SocialAccount],

            self::YoutubeMusic,
            self::AmazonMusic,
            self::Tidal => [PlatformType::StreamingService],

            self::AtEaseRecords => [PlatformType::MusicStore],
        };
    }

    public function type(): PlatformType
    {
        return $this->types()[0];
    }

    public function supports(PlatformType $type): bool
    {
        return in_array($type, $this->types(), strict: true);
    }

    public static function optionsFor(PlatformType $type): array
    {
        return collect(self::cases())
            ->filter(fn (self $case) => $case->supports($type))
            ->mapWithKeys(fn (self $case) => [$case->value => $case->label()])
            ->all();
    }
}
