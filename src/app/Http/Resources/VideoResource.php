<?php

namespace App\Http\Resources;

use App\Enums\VideoType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class VideoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'video_id' => $this->video_id,
            'category' => $this->category,
            'label' => VideoType::tryFrom($this->category)?->label() ?? Str::headline($this->category),
        ];
    }
}
