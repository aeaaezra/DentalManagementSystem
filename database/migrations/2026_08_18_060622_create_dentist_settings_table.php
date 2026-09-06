<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Create dentist settings table
    public function up(): void
    {
        Schema::create('dentist_settings', function (Blueprint $table) {

            // Primary key
            $table->id();

            // The dentist/user who owns these settings
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            // Appointment notifications
            $table->boolean('appointment_notifications')
                ->default(true);

            // Treatment notifications
            $table->boolean('treatment_notifications')
                ->default(true);

            // System notifications
            $table->boolean('system_notifications')
                ->default(true);

            // Created and updated timestamps
            $table->timestamps();
        });
    }

    // Remove dentist settings table
    public function down(): void
    {
        Schema::dropIfExists('dentist_settings');
    }
};
