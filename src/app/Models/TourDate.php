<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['venue_id', 'date', 'ticket_url', 'sold_out'])]
class TourDate extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'sold_out' => 'boolean',
        ];
    }

    /* Relations */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }
}
