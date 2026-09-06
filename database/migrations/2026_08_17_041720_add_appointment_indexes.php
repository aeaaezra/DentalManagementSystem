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
        Schema::table('appointments', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Patient History
            |--------------------------------------------------------------------------
            |
            | Most patient appointment queries will use:
            |
            | patient_record_id + appointment_date
            |
            */

            $table->index(
                ['patient_record_id', 'appointment_date'],
                'appointments_patient_date_index'
            );

            /*
            |--------------------------------------------------------------------------
            | Appointment Schedule
            |--------------------------------------------------------------------------
            |
            | Useful for checking appointment availability.
            |
            */

            $table->index(
                ['appointment_date', 'appointment_time'],
                'appointments_date_time_index'
            );

            /*
            |--------------------------------------------------------------------------
            | Status + Date
            |--------------------------------------------------------------------------
            |
            | Useful for upcoming/pending/completed appointment queries.
            |
            */

            $table->index(
                ['status', 'appointment_date'],
                'appointments_status_date_index'
            );

            /*
            |--------------------------------------------------------------------------
            | Doctor + Date
            |--------------------------------------------------------------------------
            |
            | Useful when checking a doctor's appointments.
            |
            */

            $table->index(
                ['doctor_name', 'appointment_date'],
                'appointments_doctor_date_index'
            );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {

            $table->dropIndex(
                'appointments_patient_date_index'
            );

            $table->dropIndex(
                'appointments_date_time_index'
            );

            $table->dropIndex(
                'appointments_status_date_index'
            );

            $table->dropIndex(
                'appointments_doctor_date_index'
            );

        });
    }
};
