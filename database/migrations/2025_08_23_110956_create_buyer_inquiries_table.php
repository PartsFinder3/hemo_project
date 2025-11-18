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
        Schema::create('buyer_inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_make_id')->constrained('car_makes')->onDelete('cascade')->nullable();
            $table->foreignId('car_model_id')->constrained('car_models')->onDelete('cascade')->nullable();
            $table->foreignId('year_id')->constrained('years')->onDelete('cascade')->nullable();
            $table->foreignId('buyer_id')->constrained('buyers')->onDelete('cascade')->nullable();
            $table->json('parts')->nullable();
            $table->enum('condition', ['new', 'used','does_not_matter'])->nullable();
            $table->string('vin_num')->nullable();
            $table->string('oem_num')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_inquiries');
    }
};
