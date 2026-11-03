<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient_treatments', function (Blueprint $table) {
            $table->uuid('visit_group_id')->nullable()->after('patient_record_id');
            $table->index('visit_group_id');
        });
    }

    public function down(): void
    {
        Schema::table('patient_treatments', function (Blueprint $table) {
            $table->dropIndex(['visit_group_id']);
            $table->dropColumn('visit_group_id');
        });
    }
};
