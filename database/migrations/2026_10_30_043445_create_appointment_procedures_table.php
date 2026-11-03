
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_procedures', function (Blueprint $table) {
            $table->id();

            $table->foreignId('appointment_id')
                ->constrained('appointments')
                ->cascadeOnDelete();

            $table->foreignId('service_procedure_id')
                ->constrained('service_procedures')
                ->restrictOnDelete();

            // Preserve procedure information at booking time.
            $table->string('procedure_name');
            $table->string('category_name');
            $table->string('pricing_unit')->nullable();

            // Price and duration snapshots.
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('duration_minutes');

            $table->timestamps();

            // Prevent duplicate procedures in one appointment.
            $table->unique(
                ['appointment_id', 'service_procedure_id'],
                'appointment_procedure_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_procedures');
    }
};

