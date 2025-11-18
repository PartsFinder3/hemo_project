<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('car_models', function (Blueprint $table) {
            // Drop old unique index if it exists
            $table->dropUnique('car_models_slug_unique');

            // Now modify the column
            $table->string('slug')->nullable()->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('car_models', function (Blueprint $table) {
            $table->dropUnique('car_models_slug_unique');
            $table->string('slug')->nullable(false)->change();
            $table->unique('slug'); // restore old index
        });
    }
};
