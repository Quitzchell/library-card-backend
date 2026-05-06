<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BiographyImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'position' => $this->resource['position'],
            'url' => $this->resource['url'],
            'alt' => $this->resource['alt'],
        ];
    }
}
