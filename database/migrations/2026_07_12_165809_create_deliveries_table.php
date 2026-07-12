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
    Schema::create('deliveries', function (Blueprint $table) {
        $table->id();

        $table->foreignId('claim_id')
              ->constrained('claims')
              ->onDelete('cascade');

        $table->foreignId('volunteer_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->enum('status', [
            'pending',
            'accepted',
            'picked_up',
            'delivered'
        ])->default('pending');

        $table->timestamp('accepted_at')->nullable();
        $table->timestamp('picked_up_at')->nullable();
        $table->timestamp('delivered_at')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
