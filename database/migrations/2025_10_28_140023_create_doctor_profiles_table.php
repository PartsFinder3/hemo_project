<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('specialization')->nullable();
            $table->string('qualifications')->nullable();
            $table->integer('experience_years')->nullable();
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->string('license_number')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospital_profiles')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_profiles');
    }
};