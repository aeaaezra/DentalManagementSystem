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
        Schema::create('patient_records', function (Blueprint $table) {
            
                $table->id();

            // Patient Information
            $table->string('patient_name', 150);
            $table->integer('age')->nullable();
            $table->enum('sex', ['Male', 'Female'])->nullable();
            $table->string('civil_status', 50)->nullable();
            $table->string('tel_no', 30)->nullable();
            $table->string('occupation', 100)->nullable();
            $table->text('address')->nullable();

            // Medical History
            $table->boolean('heart_condition')->default(false);
            $table->string('heart_condition_details', 255)->nullable();
            $table->boolean('allergy')->default(false);
            $table->string('allergy_details', 255)->nullable();

            $table->boolean('diabetes')->default(false);
            $table->string('diabetes_details', 255)->nullable();

            $table->boolean('hypertension')->default(false);
            $table->string('hypertension_details', 255)->nullable();

            $table->boolean('bleeding_tendency')->default(false);
            $table->string('bleeding_tendency_details', 255)->nullable();

            $table->boolean('asthma')->default(false);
            $table->string('asthma_details', 255)->nullable();

            $table->text('other_diseases_treatments')->nullable();
            $table->string('patient_signature', 150)->nullable();

            $table->timestamps();


            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_records');
    }
};
