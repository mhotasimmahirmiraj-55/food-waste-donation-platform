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
        Schema::create('food_donation_items', function (Blueprint $table) {

            $table->id();

            // Main donation
            $table->foreignId('food_donation_id')
                  ->constrained('food_donations')
                  ->onDelete('cascade');

            // Food category
            $table->foreignId('food_category_id')
                  ->constrained('food_categories')
                  ->onDelete('cascade');
            $table->string('item_name');

            // Quantity of this particular food
            $table->decimal('quantity', 10, 2);

            // kg, liter, box, packet, piece etc.
            $table->string('unit', 30);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_donation_items');
    }
};