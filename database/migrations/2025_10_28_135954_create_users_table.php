<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->boolean('is_verified')->default(false);
            $table->boolean('status')->default(true);
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();

            // Only this foreign key is safe
            $table->foreign('role_id')
                  ->references('id')
                  ->on('user_roles')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};