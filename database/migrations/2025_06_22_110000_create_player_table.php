<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player', function (Blueprint $table) {
            $table->increments('player_id');
            $table->string('username', 20)->default('');
            $table->string('first_name', 20)->nullable();
            $table->string('last_name', 20)->nullable();
            $table->string('email', 100)->default('');
            $table->string('timezone', 255)->default('UTC');
            $table->unsignedTinyInteger('is_admin')->default(0);
            $table->string('password', 32)->default('');
            $table->string('alt_pass', 32)->default('');
            $table->string('ident', 32)->nullable();
            $table->string('token', 32)->nullable();
            $table->timestamp('create_date')->useCurrent();
            $table->unsignedTinyInteger('is_approved')->default(0);
            $table->unique('username');
            $table->unique('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player');
    }
};
