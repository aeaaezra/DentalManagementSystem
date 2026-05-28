<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code', 50)->unique();
            $table->string('barcode', 100)->nullable()->unique();
            $table->string('product_name', 150);
            $table->string('generic_name', 150)->nullable();
            $table->string('brand_name', 150)->nullable();

            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('unit_id')->constrained('units')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete()->cascadeOnUpdate();

            $table->text('description')->nullable();
            $table->enum('item_type', ['consumable', 'medicine', 'instrument', 'equipment', 'other'])->default('consumable');

            $table->decimal('purchase_price', 12, 2)->default(0.00);
            $table->decimal('selling_price', 12, 2)->default(0.00);

            $table->integer('reorder_level')->default(0);
            $table->integer('maximum_stock')->default(0);

            $table->boolean('requires_expiry_tracking')->default(true);
            $table->boolean('requires_batch_tracking')->default(true);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
