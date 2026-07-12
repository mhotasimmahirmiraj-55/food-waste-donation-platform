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
    Schema::create('food_donations', function (Blueprint $table) {
        $table->id();

        $table->foreignId('donor_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->foreignId('food_category_id')
              ->constrained('food_categories')
              ->onDelete('cascade');

        $table->string('title');
        $table->text('description')->nullable();

        $table->integer('quantity');

        $table->dateTime('expiry_time');

        $table->string('pickup_address');
        $table->decimal('latitude', 10, 7)->nullable();
        $table->decimal('longitude', 10, 7)->nullable();

        $table->date('pickup_date')->nullable();
        $table->time('pickup_time')->nullable();

        $table->enum('status', [
            'available',
            'claimed',
            'delivered',
            'expired',
            'cancelled'
        ])->default('available');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_donations');
    }
};
