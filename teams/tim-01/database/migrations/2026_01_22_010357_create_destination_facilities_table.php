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
    Schema::create('destination_facilities', function (Blueprint $table) {
        // Karena ini tabel pivot, kita butuh 2 ID
        $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete();
        $table->foreignId('facility_id')->constrained('facilities')->cascadeOnDelete();
        
        // Mencegah duplikasi (Satu wisata tidak bisa punya 2 fasilitas yang sama persis di database)
        $table->primary(['destination_id', 'facility_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_facilities');
    }
};
