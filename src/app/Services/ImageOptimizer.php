<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class ImageOptimizer
{
    public const MAX_FILE_SIZE_BYTES = 5 * 1024 * 1024;

    public const MAX_DIMENSION = 6000;

    public const OPTIMIZE_MAX_DIMENSION = 1920;

    public const WEBP_QUALITY = 85;

    public const ALLOWED_MIME_TYPES = ['image/jpeg', 'image/png', 'image/webp'];

    public function optimize(string $sourcePath): string
    {
        $manager = ImageManager::imagick();
        $image = $manager->read($sourcePath);

        $profile = null;
        try {
            $profile = $image->profile();
        } catch (\Throwable) {
            // Source has no embedded ICC profile.
        }

        $image->scaleDown(
            width: self::OPTIMIZE_MAX_DIMENSION,
            height: self::OPTIMIZE_MAX_DIMENSION,
        );

        // Flatten any transparency onto a white background so the resulting
        // WebP renders consistently regardless of viewer alpha handling.
        $flattened = $manager->create($image->width(), $image->height())
            ->fill('ffffff')
            ->place($image);

        if ($profile !== null) {
            try {
                $flattened->setProfile($profile);
            } catch (\Throwable) {
                // ICC profile preservation is best-effort.
            }
        }

        return (string) $flattened->encode(new WebpEncoder(quality: self::WEBP_QUALITY));
    }

    public function validateDimensions(string $sourcePath): void
    {
        $image = ImageManager::imagick()->read($sourcePath);

        if ($image->width() > self::MAX_DIMENSION || $image->height() > self::MAX_DIMENSION) {
            throw ValidationException::withMessages([
                'image' => sprintf(
                    'Image dimensions must be at most %dx%d. Got %dx%d.',
                    self::MAX_DIMENSION,
                    self::MAX_DIMENSION,
                    $image->width(),
                    $image->height(),
                ),
            ]);
        }
    }

    public static function storageFilename(string $originalName): string
    {
        $stem = pathinfo($originalName, PATHINFO_FILENAME);
        $stem = preg_replace('/[^A-Za-z0-9_-]/', '', $stem) ?? '';

        if ($stem === '') {
            $stem = 'image';
        }

        $hex = bin2hex(random_bytes(6));

        return "{$hex}_{$stem}.webp";
    }
}
