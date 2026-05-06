<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Settings\BiographySettings;

class AboutController extends Controller
{
    public function show(): AboutResource
    {
        return new AboutResource(app(BiographySettings::class));
    }
}
