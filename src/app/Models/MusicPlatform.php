<?php

namespace App\Models;

use App\Enums\Platform;
use App\Enums\PlatformType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['music_id', 'platform_type', 'platform', 'url', 'label', 'sort'])]
class MusicPlatform extends Model
{
    protected function casts(): array
    {
        return [
            'platform_type' => PlatformType::class,
            'platform' => Platform::class,
        ];
    }

    /* Relations */
    public function music(): BelongsTo
    {
        return $this->belongsTo(Music::class);
    }
}
