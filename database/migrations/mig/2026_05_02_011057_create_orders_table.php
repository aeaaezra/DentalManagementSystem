<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('order_no')->unique();
            $table->string('customer_name');
            $table->string('contact_number')->nullable();
            $table->text('address')->nullable();

            $table->decimal('total_amount', 10, 2)->default(0);

            $table->enum('payment_method', ['cash', 'gcash', 'cod'])->default('cod');
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid');

            $table->enum('status', [
                'pending',
                'approved',
                'preparing',
                'completed',
                'cancelled',
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
