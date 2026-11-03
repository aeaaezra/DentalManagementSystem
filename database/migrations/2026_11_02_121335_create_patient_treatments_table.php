<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_treatments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_record_id')
                ->constrained('patient_records')
                ->cascadeOnDelete();

            $table->date('treatment_date');
            $table->text('problem_diagnosis');
            $table->json('tooth_numbers');

            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('deposit', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_treatments');
    }
};
