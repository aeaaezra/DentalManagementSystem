<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {

    $table->id();

    $table->string('invoice_number')->unique();

    $table->foreignId('patient_record_id')
          ->nullable()
          ->constrained('patient_records')
          ->nullOnDelete();

    $table->enum('module', [
        'appointment',
        'pos',
        'ordering',
        'econsultation'
    ]);

    $table->unsignedBigInteger('reference_id');

    $table->decimal('subtotal',10,2);

    $table->decimal('discount',10,2)->default(0);

    $table->decimal('tax',10,2)->default(0);

    $table->decimal('total',10,2);

    $table->decimal('amount_paid',10,2)->default(0);

    $table->decimal('balance',10,2);

    $table->enum('payment_status',[
        'Pending',
        'Partial',
        'Paid'
    ])->default('Pending');

    $table->string('payment_method')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
