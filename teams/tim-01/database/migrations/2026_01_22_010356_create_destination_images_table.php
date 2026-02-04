<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('destination_images', function (Blueprint $table) {
        $table->id();
        // Relasi ke Destinations (Jika wisata dihapus, foto ikut terhapus)
        $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete();
        
        $table->string('image_path');
        $table->boolean('is_primary')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_images');
    }
};
