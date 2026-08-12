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
         Schema::create('treatment_guides', function (Blueprint $table) {

        $table->id();

        $table->foreignId('service_id')
                ->constrained()
                ->cascadeOnDelete();

        $table->string('situation');

        $table->string('recommendation');

        $table->string('frequency');

        $table->text('home_care');

        $table->text('foods_to_eat')->nullable();

        $table->text('foods_to_avoid')->nullable();

        $table->text('warning_signs')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_guides');
    }
};
