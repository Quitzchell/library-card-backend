<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('music_platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('music_id')->constrained('music')->cascadeOnDelete();
            $table->string('platform_type');
            $table->string('platform');
            $table->string('url');
            $table->string('label')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('music_platforms');
    }
};
