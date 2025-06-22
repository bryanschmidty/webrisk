<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wr_game_player', function (Blueprint $table) {
            $table->unsignedInteger('game_id')->default(0);
            $table->unsignedInteger('player_id')->default(0);
            $table->unsignedTinyInteger('order_num')->default(0);
            $table->string('color', 10)->default('');
            $table->string('cards')->nullable();
            $table->unsignedSmallInteger('armies')->default(0);
            $table->enum('state', ['Waiting','Trading','Placing','Attacking','Occupying','Fortifying','Resigned','Dead'])->default('Waiting');
            $table->unsignedTinyInteger('get_card')->default(0);
            $table->unsignedTinyInteger('forced')->default(0);
            $table->text('extra_info')->nullable();
            $table->timestamp('move_date')->default('0000-00-00 00:00:00')->useCurrentOnUpdate();
            $table->unique(['game_id', 'player_id'], 'game_player');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wr_game_player');
    }
};
