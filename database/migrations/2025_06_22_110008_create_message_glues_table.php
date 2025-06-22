<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('message_glues', function (Blueprint $table) {
            $table->increments('message_glue_id');
            $table->unsignedInteger('message_id')->default(0);
            $table->unsignedInteger('from_id')->default(0);
            $table->unsignedInteger('to_id')->default(0);
            $table->dateTime('send_date')->nullable();
            $table->dateTime('expire_date')->nullable();
            $table->dateTime('view_date')->nullable();
            $table->timestamp('create_date')->useCurrent();
            $table->unsignedTinyInteger('deleted')->default(0);
            $table->index(['from_id', 'message_id'], 'outbox');
            $table->index('create_date', 'created');
            $table->index('expire_date');
            $table->index(['to_id', 'from_id', 'send_date', 'deleted'], 'inbox');
            $table->index(['message_id', 'to_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_glues');
    }
};
