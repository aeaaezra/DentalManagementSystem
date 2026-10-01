<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_usage', function (Blueprint $table) {
            $table->id();
            $table->string('usage_no', 50)->unique();
            $table->foreignId('used_by')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->dateTime('usage_date')->useCurrent();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_usage');
    }
};
