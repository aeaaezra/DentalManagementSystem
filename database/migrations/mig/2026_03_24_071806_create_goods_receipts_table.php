<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goods_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('grn_number', 50)->unique();
            $table->foreignId('purchase_order_id')->nullable()->constrained('purchase_orders')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('suppliers_id')->constrained('suppliers')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('received_by')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->date('received_date');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goods_receipts');
    }
};
