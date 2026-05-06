<?php

namespace App\Models;

use App\Observers\MusicObserver;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['title', 'release_date', 'cover_image'])]
#[ObservedBy(MusicObserver::class)]
class Music extends Model
{
    use HasFactory;

    protected $table = 'music';

    protected function casts(): array
    {
        return [
            'release_date' => 'date',
        ];
    }

    /* Relation */
    public function platforms(): HasMany
    {
        return $this->hasMany(MusicPlatform::class);
    }
}
