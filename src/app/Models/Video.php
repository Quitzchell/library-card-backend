<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'video_id', 'category', 'sort'])]
class Video extends Model
{
    use HasFactory;

    /* Mutators */
    protected function videoId(): Attribute
    {
        return Attribute::set(function (string $value): string {
            $pattern = '~(?:youtu\.be/|youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/))([a-zA-Z0-9_-]{11})~';

            return preg_match($pattern, $value, $matches) === 1
                ? $matches[1]
                : trim($value);
        });
    }
}
