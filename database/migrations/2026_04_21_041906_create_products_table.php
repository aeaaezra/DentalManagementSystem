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

            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('sku')->unique();
            $table->string('product_name');
            $table->string('brand_name')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('unit')->default('pcs');

            $table->decimal('cost_price', 12, 2)->default(0);
            $table->decimal('selling_price', 12, 2)->default(0);

            $table->integer('quantity_on_hand')->default(0);
            $table->integer('reorder_level')->default(0);

            $table->date('expiration_date')->nullable();

            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
