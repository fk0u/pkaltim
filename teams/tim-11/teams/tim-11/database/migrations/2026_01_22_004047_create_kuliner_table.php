<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kuliner', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kuliner');
            $table->text('deskripsi');
            $table->string('asal_daerah');
            $table->string('gambar')->nullable();

            $table->foreignId('place_id')
                  ->constrained('places')
                  ->cascadeOnDelete();

            $table->foreignId('created_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuliner');
    }
};
