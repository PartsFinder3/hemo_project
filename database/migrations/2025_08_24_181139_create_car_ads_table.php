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
        Schema::create('car_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('car_make_id')->constrained('car_makes')->onDelete('cascade');
            $table->foreignId('car_model_id')->constrained('car_models')->onDelete('cascade');
            $table->foreignId('year_id')->constrained('years')->onDelete('cascade');
            $table->foreignId('fuel_id')->constrained('fuel')->onDelete('cascade');
            $table->foreignId('engine_size_id')->constrained('engine_size')->onDelete('cascade');
            $table->string('vin_number');
            $table->string('trade_license_number');
            $table->string('condition');
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_ads');
    }
};
