<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('location_id')->constrained('locations')->restrictOnDelete()->cascadeOnUpdate();

            $table->string('batch_no', 100);
            $table->string('lot_no', 100)->nullable();

            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date')->nullable();

            $table->integer('quantity_received')->default(0);
            $table->integer('quantity_available')->default(0);
            $table->decimal('unit_cost', 12, 2)->default(0.00);

            $table->date('received_date');
            $table->enum('status', ['active', 'consumed', 'expired', 'damaged'])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_batches');
    }
};
