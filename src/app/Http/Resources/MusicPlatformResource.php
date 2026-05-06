<?php

namespace App\Http\Resources;

use App\Enums\PlatformType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MusicPlatformResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'platform' => $this->platform->label(),
            'label' => $this->platform_type === PlatformType::MusicStore && filled($this->label)
                ? $this->label
                : null,
            'url' => $this->url,
        ];
    }
}
