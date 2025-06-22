<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_lands', function (Blueprint $table) {
            $table->unsignedInteger('game_id')->default(0);
            $table->unsignedInteger('land_id')->default(0);
            $table->unsignedInteger('player_id')->default(0);
            $table->unsignedSmallInteger('armies')->default(0);
            $table->unique(['game_id', 'land_id'], 'game_land');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_lands');
    }
};
