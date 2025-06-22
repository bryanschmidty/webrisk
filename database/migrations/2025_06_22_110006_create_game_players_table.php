<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_players', function (Blueprint $table) {
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
            $table->timestamp('move_date')->useCurrent()->useCurrentOnUpdate();
            $table->unique(['game_id', 'player_id'], 'game_player_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_players');
    }
};
