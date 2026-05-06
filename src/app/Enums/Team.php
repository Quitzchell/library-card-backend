<?php

namespace App\Enums;

enum Team: string
{
    case Bookings = 'bookings';
    case Management = 'management';
    case Promotion = 'promotion';

    public function label(): string
    {
        return match ($this) {
            self::Bookings => 'Bookings',
            self::Management => 'Management',
            self::Promotion => 'Promotion',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->label()])
            ->all();
    }
}
