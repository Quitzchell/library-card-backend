<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Revalidation
{
    public static function trigger(array $paths): void
    {
        $url = config('revalidation.url');
        $secret = config('revalidation.secret');

        if (! $url || ! $secret || empty($paths)) {
            return;
        }

        try {
            Http::withHeaders(['x-revalidation-secret' => $secret])
                ->timeout(10)
                ->post($url, ['paths' => array_values(array_unique($paths))]);
        } catch (\Throwable $e) {
            Log::warning('Revalidation webhook failed', [
                'paths' => $paths,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public static function triggerFor(string $key): void
    {
        $paths = config("revalidation.paths.{$key}", []);

        if (empty($paths)) {
            return;
        }

        self::trigger($paths);
    }
}
