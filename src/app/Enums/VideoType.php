<?php

namespace App\Enums;

enum VideoType: string
{
    case VideoClip = 'video_clip';
    case Live = 'live';

    public function label(): string
    {
        return match ($this) {
            self::VideoClip => 'Video Clip',
            self::Live => 'Live',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->label()])
            ->all();
    }
}
