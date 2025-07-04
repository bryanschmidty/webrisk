<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('message_id');
            $table->string('subject');
            $table->text('message');
            $table->timestamp('create_date')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
