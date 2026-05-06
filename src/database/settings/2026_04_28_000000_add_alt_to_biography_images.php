<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->update('biography.images', fn (array $images): array => array_map(
            fn ($item): array => match (true) {
                is_string($item) => ['path' => $item, 'alt' => ''],
                is_array($item) => $item,
                default => (array) $item,
            },
            $images,
        ));
    }

    public function down(): void
    {
        $this->migrator->update('biography.images', fn (array $images): array => array_map(
            fn ($item) => match (true) {
                is_array($item) => $item['path'] ?? '',
                is_object($item) => $item->path ?? '',
                default => $item,
            },
            $images,
        ));
    }
};
