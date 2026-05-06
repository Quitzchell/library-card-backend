<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('biography.title', '');
        $this->migrator->add('biography.text', '');
        $this->migrator->add('biography.images', []);
    }

    public function down(): void
    {
        $this->migrator->deleteIfExists('biography.title');
        $this->migrator->deleteIfExists('biography.text');
        $this->migrator->deleteIfExists('biography.images');
    }
};
