<?php

namespace App\Observers;

use App\Models\Music;
use Illuminate\Support\Facades\Storage;

class MusicObserver
{
    public function saving(Music $music): void
    {
        if (! $music->isDirty('cover_image')) {
            return;
        }

        $original = $music->getOriginal('cover_image');

        if ($original) {
            Storage::disk(config('images.disk'))->delete($original);
        }
    }

    public function deleted(Music $music): void
    {
        if ($music->cover_image) {
            Storage::disk(config('images.disk'))->delete($music->cover_image);
        }
    }
}
