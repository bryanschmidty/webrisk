<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wr_roll_log', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('attack_1')->default(0);
            $table->unsignedTinyInteger('attack_2')->nullable();
            $table->unsignedTinyInteger('attack_3')->nullable();
            $table->unsignedTinyInteger('defend_1')->default(0);
            $table->unsignedTinyInteger('defend_2')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wr_roll_log');
    }
};
