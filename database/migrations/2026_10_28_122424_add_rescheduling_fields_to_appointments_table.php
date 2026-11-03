<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->date('reschedule_date')->nullable();
            $table->time('reschedule_time')->nullable();
            $table->time('reschedule_end_time')->nullable();
            $table->text('reschedule_reason')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'reschedule_date',
                'reschedule_time',
                'reschedule_end_time',
                'reschedule_reason',
            ]);
        });
    }
};
