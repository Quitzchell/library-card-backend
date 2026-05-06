<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class BiographySettings extends Settings
{
    public string $title;

    public string $text;

    public array $images;

    public static function group(): string
    {
        return 'biography';
    }
}
