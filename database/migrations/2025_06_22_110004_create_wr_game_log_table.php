<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wr_game_log', function (Blueprint $table) {
            $table->unsignedInteger('game_id')->default(0);
            $table->string('data')->nullable();
            $table->dateTime('create_date', 6)->default('0000-00-00 00:00:00.000000');
            $table->decimal('microsecond', 18, 8)->default(0);
            $table->unique(['game_id', 'create_date', 'microsecond'], 'game_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wr_game_log');
    }
};
