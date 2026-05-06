<?php

namespace App\Models;

use App\Enums\Team;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['team', 'region', 'first_name', 'last_name', 'organization', 'email'])]
class TeamMember extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'team' => Team::class,
        ];
    }

    /* Accessors */
    protected function fullName(): Attribute
    {
        return Attribute::get(fn (): string => implode(' ', [$this->first_name, $this->last_name]));
    }
}
