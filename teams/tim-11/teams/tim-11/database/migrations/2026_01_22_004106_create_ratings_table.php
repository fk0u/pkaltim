<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('kuliner_id')
                  ->constrained('kuliner')
                  ->cascadeOnDelete();

            $table->tinyInteger('rating'); // 1 - 5
            $table->timestamps();

            $table->unique(['user_id', 'kuliner_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
