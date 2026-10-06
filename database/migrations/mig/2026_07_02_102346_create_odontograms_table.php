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

        Schema::create('odontograms', function (Blueprint $table) {

            $table->id();

            $table->foreignId('patient_record_id')
                  ->constrained('patient_records')
                  ->cascadeOnDelete();

            $table->string('tooth_number');      // Example: 18, 36, 55
            $table->string('condition');         // Healthy, Filling, Missing...
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odontograms');
    }
};
