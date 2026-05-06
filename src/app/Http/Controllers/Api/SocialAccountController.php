<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialAccountResource;
use App\Models\SocialAccount;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SocialAccountController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return SocialAccountResource::collection(
            SocialAccount::query()
                ->where('is_active', true)
                ->orderBy('sort')
                ->get()
        );
    }
}
