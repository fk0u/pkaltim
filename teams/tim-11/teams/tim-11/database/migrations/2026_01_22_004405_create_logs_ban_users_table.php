<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('logs_ban_users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('banned_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('reason');
            $table->timestamp('banned_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs_ban_users');
    }
};
