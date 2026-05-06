<?php

namespace App\Http\Controllers\Api;

use App\Enums\Team;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamMemberResource;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TeamMemberController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $team = $request->string('team')->toString();

        if ($team !== '' && Team::tryFrom($team) === null) {
            return TeamMemberResource::collection(collect());
        }

        $query = TeamMember::query()->orderBy('team')->orderBy('sort');

        if ($team !== '') {
            $query->where('team', $team);
        }

        return TeamMemberResource::collection($query->get());
    }
}
