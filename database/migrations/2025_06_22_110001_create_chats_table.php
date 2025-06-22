<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('chat_id');
            $table->text('message');
            $table->unsignedInteger('from_id')->default(0);
            $table->unsignedInteger('game_id')->default(0);
            $table->unsignedTinyInteger('private')->default(0);
            $table->timestamp('create_date')->useCurrent();
            $table->index('game_id');
            $table->index('private');
            $table->index('from_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
