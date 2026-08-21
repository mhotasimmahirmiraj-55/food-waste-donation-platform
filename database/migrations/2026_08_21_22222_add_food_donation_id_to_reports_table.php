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
        Schema::table('reports', function (Blueprint $table) {

            $table->foreignId('food_donation_id')
                ->nullable()
                ->after('reported_user_id')
                ->constrained('food_donations')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {

            $table->dropForeign(['food_donation_id']);

            $table->dropColumn('food_donation_id');

        });
    }
};