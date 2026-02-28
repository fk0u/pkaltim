<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kuliner_categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kuliner_id')
                  ->constrained('kuliner')
                  ->cascadeOnDelete();

            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->cascadeOnDelete();

            $table->unique(['kuliner_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuliner_categories');
    }
};
