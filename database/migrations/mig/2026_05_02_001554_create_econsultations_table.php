<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_consultations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_record_id')
                ->constrained('patient_records')
                ->cascadeOnDelete();

            $table->foreignId('appointment_id')
                ->nullable()
                ->constrained('appointments')
                ->nullOnDelete();

            $table->dateTime('consultation_datetime')->nullable();

            $table->text('chief_complaint')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('first_aid_advice')->nullable();
            $table->text('consultation_notes')->nullable();

            $table->enum('consultation_type', [
                'chat',
                'video_call',
                'phone_call',
            ])->default('chat');

            $table->enum('status', [
                'waiting',
                'ongoing',
                'completed',
                'cancelled',
            ])->default('waiting');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_consultations');
    }
};
