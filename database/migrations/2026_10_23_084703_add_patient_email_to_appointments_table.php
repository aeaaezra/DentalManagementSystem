<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('appointments', 'patient_email')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->string('patient_email')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('appointments', 'patient_email')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('patient_email');
            });
        }
    }
};
