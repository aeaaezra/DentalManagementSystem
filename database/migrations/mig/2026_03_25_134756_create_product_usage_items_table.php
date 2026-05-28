<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_usage_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_usage_id')->constrained('product_usage')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('batch_id')->nullable()->constrained('product_batches')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('location_id')->constrained('locations')->restrictOnDelete()->cascadeOnUpdate();
            $table->integer('quantity_used');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_usage_items');
    }
};
