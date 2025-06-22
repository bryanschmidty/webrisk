<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('game_id');
            $table->unsignedInteger('host_id')->default(0);
            $table->string('name');
            $table->string('password', 32)->nullable();
            $table->unsignedTinyInteger('capacity')->default(2);
            $table->unsignedTinyInteger('time_limit')->nullable();
            $table->boolean('allow_kibitz')->default(false);
            $table->string('game_type')->default('Original');
            $table->unsignedTinyInteger('next_bonus')->default(4);
            $table->enum('state', ['Waiting', 'Placing', 'Playing', 'Finished'])->default('Waiting');
            $table->text('extra_info')->nullable();
            $table->text('game_settings')->nullable();
            $table->boolean('paused')->default(false);
            $table->dateTime('create_date')->useCurrent();
            $table->timestamp('modify_date')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
