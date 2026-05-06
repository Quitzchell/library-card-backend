<?php

namespace App\Http\Resources;

use App\Enums\PlatformType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MusicResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'release_date' => $this->release_date?->format('Y-m-d'),
            'cover_image' => $this->cover_image
                ? Storage::disk(config('images.disk'))->url($this->cover_image)
                : null,
            'services' => MusicPlatformResource::collection(
                $this->platforms
                    ->where('platform_type', PlatformType::StreamingService)
                    ->values()
            ),
            'stores' => MusicPlatformResource::collection(
                $this->platforms
                    ->where('platform_type', PlatformType::MusicStore)
                    ->values()
            ),
        ];
    }
}
