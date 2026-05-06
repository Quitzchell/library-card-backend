<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MusicController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Music::query()
            ->with('platforms')
            ->orderByDesc('release_date');

        $results = $request->boolean('paginate', true)
            ? $query->paginate($request->integer('per_page', 15))
            : $query->get();

        return MusicResource::collection($results);
    }

    public function show(Music $music): MusicResource
    {
        return new MusicResource($music->load('platforms'));
    }
}
