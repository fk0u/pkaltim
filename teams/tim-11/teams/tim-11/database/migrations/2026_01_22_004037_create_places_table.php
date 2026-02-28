<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tempat');
            $table->text('alamat');
            $table->string('kota');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
