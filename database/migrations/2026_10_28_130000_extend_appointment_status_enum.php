<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE appointments
            MODIFY status ENUM(
                'pending',
                'confirmed',
                'completed',
                'cancelled',
                'cancellation_requested',
                'approved',
                'declined',
                'reschedule_requested'
            ) NOT NULL DEFAULT 'pending'
        ");
    }

    public function down(): void
    {
        // Convert newer statuses before removing them from the enum.
        DB::table('appointments')
            ->where('status', 'approved')
            ->update(['status' => 'confirmed']);

        DB::table('appointments')
            ->whereIn('status', ['declined', 'reschedule_requested'])
            ->update(['status' => 'cancelled']);

        DB::statement("
            ALTER TABLE appointments
            MODIFY status ENUM(
                'pending',
                'confirmed',
                'completed',
                'cancelled',
                'cancellation_requested'
            ) NOT NULL DEFAULT 'pending'
        ");
    }
};
