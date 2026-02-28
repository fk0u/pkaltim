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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // e.g., Bug, Feature Request, General
            $table->string('subject')->nullable();
            $table->string('sender_name')->default('Anonymous');
            $table->text('message');
            $table->text('device_info')->nullable(); // User agent string
            $table->enum('status', ['unread', 'read'])->default('unread');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
