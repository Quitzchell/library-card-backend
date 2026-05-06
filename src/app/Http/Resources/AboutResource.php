<?php

namespace App\Http\Resources;

use App\Settings\BiographySettings;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var BiographySettings $bio */
        $bio = $this->resource;

        return [
            'title' => $bio->title,
            'content' => $bio->text,
        ];
    }
}
