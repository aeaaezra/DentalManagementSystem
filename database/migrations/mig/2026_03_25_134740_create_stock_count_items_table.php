<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_count_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_count_id')->constrained('stock_counts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('batch_id')->nullable()->constrained('product_batches')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('location_id')->constrained('locations')->restrictOnDelete()->cascadeOnUpdate();

            $table->integer('system_qty')->default(0);
            $table->integer('physical_qty')->default(0);
            $table->integer('variance_qty')->default(0);
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_count_items');
    }
};
