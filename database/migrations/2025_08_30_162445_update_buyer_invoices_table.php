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
        Schema::table('buyer_invoices', function (Blueprint $table) {
            // Drop foreign key first (if exists)
            if (Schema::hasColumn('buyer_invoices', 'buyer_id')) {
                $table->dropForeign(['buyer_id']);
                $table->dropColumn('buyer_id');
            }

            // Add buyer_phone if not exists
            if (!Schema::hasColumn('buyer_invoices', 'buyer_phone')) {
                $table->string('buyer_phone');
            }

            // Add buyer_address if not exists
            if (!Schema::hasColumn('buyer_invoices', 'buyer_address')) {
                $table->string('buyer_address');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buyer_invoices', function (Blueprint $table) {
            // Add buyer_id back
            if (!Schema::hasColumn('buyer_invoices', 'buyer_id')) {
                $table->unsignedBigInteger('buyer_id')->nullable();

                // Re-create the foreign key (assuming relation with buyers table)
                $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');
            }

            // Drop new columns if exist
            if (Schema::hasColumn('buyer_invoices', 'buyer_phone')) {
                $table->dropColumn('buyer_phone');
            }
            if (Schema::hasColumn('buyer_invoices', 'buyer_address')) {
                $table->dropColumn('buyer_address');
            }
        });
    }
};
