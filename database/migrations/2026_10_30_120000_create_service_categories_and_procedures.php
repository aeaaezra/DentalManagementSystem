<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();

            $table->string('category_name')->unique();

            // Connect the six existing Services records.
            // New categories will have NULL here.
            $table->foreignId('legacy_service_id')
                ->nullable()
                ->unique()
                ->constrained('services')
                ->nullOnDelete();

            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('service_procedures', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('service_categories')
		->restrictOnDelete();

            $table->string('procedure_name');
            $table->decimal('price', 10, 2);
            $table->string('pricing_unit')->nullable();
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['category_id', 'is_active']);
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('service_category_id')
                ->nullable()
                ->constrained('service_categories')
                ->nullOnDelete();

            $table->foreignId('service_procedure_id')
                ->nullable()
                ->constrained('service_procedures')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['service_procedure_id']);
            $table->dropForeign(['service_category_id']);
            $table->dropColumn([
                'service_procedure_id',
                'service_category_id',
            ]);
        });

        Schema::dropIfExists('service_procedures');
        Schema::dropIfExists('service_categories');
    }
};
