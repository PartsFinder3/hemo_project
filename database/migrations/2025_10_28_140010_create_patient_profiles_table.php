<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('disorder_type')->nullable();
            $table->string('severity')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->longText('medical_history')->nullable();
            $table->unsignedBigInteger('hospitals_id')->nullable(); // Hospital treating patient
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hospitals_id')->references('id')->on('hospital_profiles')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_profiles');
    }
};