<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wr_game_nudge', function (Blueprint $table) {
            $table->unsignedInteger('game_id')->default(0);
            $table->unsignedInteger('player_id')->default(0);
            $table->timestamp('nudged')->useCurrent();
            $table->unique(['game_id', 'player_id'], 'game_nudge_player');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wr_game_nudge');
    }
};
