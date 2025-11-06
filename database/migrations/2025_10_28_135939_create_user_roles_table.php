<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->unique();
            $table->boolean('status')->default(true);
            $table->timestamps();
            // REMOVED: created_by, updated_by → not needed for roles
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};