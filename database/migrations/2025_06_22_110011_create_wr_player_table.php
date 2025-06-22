<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wr_player', function (Blueprint $table) {
            $table->unsignedInteger('player_id')->default(0);
            $table->text('game_settings')->nullable();
            $table->unsignedTinyInteger('is_admin')->default(0);
            $table->unsignedTinyInteger('allow_email')->default(1);
            $table->string('color', 25)->default('yellow_black');
            $table->boolean('invite_opt_out')->default(false);
            $table->unsignedTinyInteger('max_games')->default(0);
            $table->unsignedSmallInteger('wins')->default(0);
            $table->unsignedSmallInteger('kills')->default(0);
            $table->unsignedSmallInteger('losses')->default(0);
            $table->timestamp('last_online')->useCurrent()->useCurrentOnUpdate();
            $table->unique('player_id', 'id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wr_player');
    }
};
