<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Livewire temp uploads must live on local disk so getRealPath()
        // returns a usable path. The default would inherit FILESYSTEM_DISK,
        // which is `s3` on Render and breaks Intervention Image decoding.
        config(['livewire.temporary_file_upload.disk' => 'local']);
    }
}
