<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourDateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date?->toIso8601String(),
            'ticket_url' => $this->ticket_url,
            'sold_out' => $this->sold_out,
            'venue' => new VenueResource($this->whenLoaded('venue')),
        ];
    }
}
