<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_counts', function (Blueprint $table) {
            $table->id();
            $table->string('count_no', 50)->unique();
            $table->foreignId('counted_by')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->date('count_date');
            $table->enum('status', ['draft', 'completed', 'approved'])->default('draft');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_counts');
    }
};
