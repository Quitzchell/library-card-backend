<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BiographyImageResource;
use App\Settings\BiographySettings;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class BiographyImageController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $bio = app(BiographySettings::class);
        $disk = Storage::disk(config('images.disk'));

        $items = collect($bio->images ?? [])
            ->values()
            ->map(fn (array $image, int $idx) => [
                'position' => $idx,
                'url' => $disk->url($image['path']),
                'alt' => $image['alt'] ?? '',
            ]);

        return BiographyImageResource::collection($items);
    }
}
