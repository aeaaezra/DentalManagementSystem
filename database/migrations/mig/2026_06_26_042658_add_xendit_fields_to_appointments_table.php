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
    $table->string('xendit_invoice_id')->nullable();
    $table->string('xendit_invoice_url')->nullable();
    $table->string('payment_status')->default('pending');
    $table->timestamp('paid_at')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            //
        });
    }
};
