<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pos_sales', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_no')->unique();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('cash_received', 10, 2)->default(0);
            $table->decimal('change_amount', 10, 2)->default(0);

            $table->enum('payment_method', ['cash', 'gcash', 'card'])->default('cash');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pos_sales');
    }
};
