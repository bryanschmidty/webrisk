<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('setting')->default('');
            $table->text('value');
            $table->text('notes')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->unique('setting');
            $table->index('sort');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
