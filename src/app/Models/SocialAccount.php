<?php

namespace App\Models;

use App\Enums\Platform;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['platform', 'url', 'is_active', 'sort'])]
class SocialAccount extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'platform' => Platform::class,
            'is_active' => 'boolean',
        ];
    }
}
