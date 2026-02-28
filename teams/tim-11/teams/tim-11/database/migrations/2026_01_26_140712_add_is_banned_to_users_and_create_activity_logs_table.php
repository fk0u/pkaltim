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
        // Add is_banned column to users table if it doesn't exist
        if (!Schema::hasColumn('users', 'is_banned')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_banned')->default(false)->after('password');
            });
        }

        // Create activity_logs table if it doesn't exist
        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
                $table->string('action');
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        
        if (Schema::hasColumn('users', 'is_banned')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_banned');
            });
        }
    }
};
