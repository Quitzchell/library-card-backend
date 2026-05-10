<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourDateResource;
use App\Models\TourDate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TourDateController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return TourDateResource::collection(
            TourDate::query()
                ->with('venue')
                ->orderByDesc('date')
                ->paginate($request->integer('per_page', 15))
        );
    }

    public function show(TourDate $tourDate): TourDateResource
    {
        return new TourDateResource($tourDate->load('venue'));
    }

    public function upcoming(Request $request): AnonymousResourceCollection
    {
        return TourDateResource::collection(
            TourDate::query()
                ->with('venue')
                ->where('date', '>=', now()->startOfDay())
                ->orderBy('date')
                ->paginate($request->integer('per_page', 15))
        );
    }

    public function past(Request $request): AnonymousResourceCollection
    {
        return TourDateResource::collection(
            TourDate::query()
                ->with('venue')
                ->where('date', '<', now()->startOfDay())
                ->orderByDesc('date')
                ->paginate($request->integer('per_page', 15))
        );
    }
}
