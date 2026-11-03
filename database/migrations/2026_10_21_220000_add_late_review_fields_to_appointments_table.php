<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (! Schema::hasColumn('appointments', 'late_review_status')) {
                $table->string('late_review_status', 40)->nullable();
            }

            if (! Schema::hasColumn('appointments', 'late_reviewed_at')) {
                $table->timestamp('late_reviewed_at')->nullable();
            }

            if (! Schema::hasColumn('appointments', 'late_reviewed_by')) {
                $table->unsignedBigInteger('late_reviewed_by')->nullable();
            }

            if (! Schema::hasColumn('appointments', 'late_review_notes')) {
                $table->text('late_review_notes')->nullable();
            }
        });
    }

    public function down(): void
    {
        $columns = [
            'late_review_status',
            'late_reviewed_at',
            'late_reviewed_by',
            'late_review_notes',
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('appointments', $column)) {
                Schema::table('appointments', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
