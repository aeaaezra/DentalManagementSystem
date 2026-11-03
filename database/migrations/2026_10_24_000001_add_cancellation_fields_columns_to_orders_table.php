<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('orders', 'cancellation_status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('cancellation_status')
                    ->default('none');
            });
        }

        if (! Schema::hasColumn('orders', 'cancellation_reason')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->text('cancellation_reason')->nullable();
            });
        }

        if (! Schema::hasColumn('orders', 'cancellation_requested_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->timestamp('cancellation_requested_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('orders', 'cancellation_requested_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('cancellation_requested_at');
            });
        }

        if (Schema::hasColumn('orders', 'cancellation_reason')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('cancellation_reason');
            });
        }

        if (Schema::hasColumn('orders', 'cancellation_status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('cancellation_status');
            });
        }
    }
};
