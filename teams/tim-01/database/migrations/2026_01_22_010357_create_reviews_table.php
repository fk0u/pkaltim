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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('destination_id')->constrained('destinations')->cascadeOnDelete();
        
        $table->string('visitor_name');
        $table->integer('rating'); // Nanti divalidasi 1-5 di Controller
        $table->text('comment')->nullable();
        $table->enum('status', ['pending', 'approved'])->default('pending');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
