<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('volunteer_ratings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('delivery_id')
                ->constrained('deliveries')
                ->onDelete('cascade');

            // Receiver who gives the rating
            $table->foreignId('giver_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Volunteer who receives the rating
            $table->foreignId('volunteer_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->unsignedTinyInteger('rating');

            $table->text('review')->nullable();

            $table->timestamps();

            // One receiver can rate a particular delivery only once
            $table->unique(['delivery_id', 'giver_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteer_ratings');
    }
};