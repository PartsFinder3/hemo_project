<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained('car_models')->onDelete('cascade');
            $table->foreignId('fuel_id')->constrained('fuel')->onDelete('cascade');
            $table->foreignId('engine_size_id')->constrained('engine_size')->onDelete('cascade');
            $table->enum('transmission', ['Manual', 'Automatic', 'CVT', 'Semi-Automatic', 'Dual-Clutch'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_variants');
    }
};
