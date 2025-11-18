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
        Schema::create('buyer_inquiry_part', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_inquiry_id')->constrained('buyer_inquiries')->onDelete('cascade');
            $table->foreignId('part_id')->constrained('spare_parts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_inquiry_part');
    }
};
