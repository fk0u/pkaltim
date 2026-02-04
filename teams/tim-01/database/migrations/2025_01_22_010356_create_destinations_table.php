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
       Schema::create('destinations', function (Blueprint $table) {
        $table->id();
        // Foreign Key ke Categories (Jika kategori dihapus, set NULL)
        $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
        
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->string('address')->nullable();
        
        // Info Harga
        $table->decimal('price', 12, 2)->default(0);
        $table->string('price_note')->nullable(); // misal: "per orang"
        
        // Info Maps (Decimal presisi tinggi)
        $table->decimal('latitude', 10, 8)->nullable();
        $table->decimal('longitude', 11, 8)->nullable();
        
        $table->string('opening_hours')->nullable();
        $table->enum('status', ['active', 'inactive'])->default('active');
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
