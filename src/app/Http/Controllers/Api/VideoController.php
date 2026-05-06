<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VideoController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Video::query()->orderBy('sort');

        if ($category = $request->string('category')->toString()) {
            $query->where('category', $category);
        }

        if ($take = $request->integer('take')) {
            $query->limit($take);
        }

        return VideoResource::collection($query->get());
    }
}
