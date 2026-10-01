<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_records', function (Blueprint $table) {
            $table->id();

            $table->string('patient_name');
            $table->integer('age')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->string('civil_status')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('occupation')->nullable();
            $table->text('address')->nullable();

            $table->boolean('heart_condition')->default(false);
            $table->string('heart_condition_details')->nullable();

            $table->boolean('allergy')->default(false);
            $table->string('allergy_details')->nullable();

            $table->boolean('diabetes')->default(false);
            $table->string('diabetes_details')->nullable();

            $table->boolean('hypertension')->default(false);
            $table->string('hypertension_details')->nullable();

            $table->boolean('bleeding_tendency')->default(false);
            $table->string('bleeding_tendency_details')->nullable();

            $table->boolean('asthma')->default(false);
            $table->string('asthma_details')->nullable();

            $table->text('other_conditions')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_records');
    }
};
