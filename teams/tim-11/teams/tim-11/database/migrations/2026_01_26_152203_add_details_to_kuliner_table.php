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
        Schema::table('kuliner', function (Blueprint $table) {
            $table->string('google_maps_url')->nullable()->after('asal_daerah');
            $table->string('external_image_url')->nullable()->after('gambar');
            $table->boolean('is_vegetarian')->default(false)->after('external_image_url');
            $table->boolean('is_halal')->default(true)->after('is_vegetarian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kuliner', function (Blueprint $table) {
            $table->dropColumn(['google_maps_url', 'external_image_url', 'is_vegetarian', 'is_halal']);
        });
    }
};
