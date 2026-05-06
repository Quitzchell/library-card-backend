<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('team');
            $table->string('region');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('organization')->nullable();
            $table->string('email');
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();

            $table->index(['team', 'sort']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
