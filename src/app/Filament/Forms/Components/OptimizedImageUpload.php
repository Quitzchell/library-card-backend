<?php

namespace App\Filament\Forms\Components;

use App\Services\ImageOptimizer;
use Filament\Forms\Components\FileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class OptimizedImageUpload extends FileUpload
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->image()
            ->disk(config('images.disk'))
            ->visibility('public')
            ->maxSize((int) (ImageOptimizer::MAX_FILE_SIZE_BYTES / 1024))
            ->acceptedFileTypes(ImageOptimizer::ALLOWED_MIME_TYPES)
            ->helperText(sprintf(
                'JPEG, PNG or WebP. Max %d MB, up to %d×%d px.',
                (int) (ImageOptimizer::MAX_FILE_SIZE_BYTES / 1024 / 1024),
                ImageOptimizer::MAX_DIMENSION,
                ImageOptimizer::MAX_DIMENSION,
            ))
            ->saveUploadedFileUsing(function (TemporaryUploadedFile $file, FileUpload $component): string {
                $optimizer = app(ImageOptimizer::class);

                $optimizer->validateDimensions($file->getRealPath());
                $contents = $optimizer->optimize($file->getRealPath());

                $filename = ImageOptimizer::storageFilename($file->getClientOriginalName());
                $directory = trim((string) $component->getDirectory(), '/');
                $path = $directory === '' ? $filename : "{$directory}/{$filename}";

                $component->getDisk()->put($path, $contents, 'public');

                return $path;
            });
    }
}
