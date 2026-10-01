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
    Schema::create('notifications', function (Blueprint $table) {
            // Unique notification ID
            $table->uuid('id')->primary();

            // User who receives the notification
            $table->string('type');

            // Supports User model / other notifiable models
            $table->morphs('notifiable');

            // Notification contents
            $table->text('data');

            // NULL = unread
            // Timestamp = read
            $table->timestamp('read_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
