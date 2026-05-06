<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\BiographyImageController;
use App\Http\Controllers\Api\MusicController;
use App\Http\Controllers\Api\SocialAccountController;
use App\Http\Controllers\Api\TeamMemberController;
use App\Http\Controllers\Api\TourDateController;
use App\Http\Controllers\Api\VideoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('music', MusicController::class)->only(['index', 'show']);

// Custom tour-dates routes must be declared before the {tour_date} binding
// so /api/tour-dates/upcoming isn't swallowed by the resource's show route.
Route::get('tour-dates/upcoming', [TourDateController::class, 'upcoming']);
Route::get('tour-dates/past', [TourDateController::class, 'past']);
Route::apiResource('tour-dates', TourDateController::class)->only(['index', 'show']);

Route::get('videos', [VideoController::class, 'index']);
Route::get('team-members', [TeamMemberController::class, 'index']);
Route::get('social-accounts', [SocialAccountController::class, 'index']);
Route::get('about', [AboutController::class, 'show']);
Route::get('biography-images', [BiographyImageController::class, 'index']);
