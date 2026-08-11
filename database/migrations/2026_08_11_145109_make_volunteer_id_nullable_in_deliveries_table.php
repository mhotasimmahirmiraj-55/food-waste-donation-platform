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
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropForeign(['volunteer_id']);

            $table->foreignId('volunteer_id')
                ->nullable()
                ->change();

            $table->foreign('volunteer_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropForeign(['volunteer_id']);

            $table->foreignId('volunteer_id')
                ->nullable(false)
                ->change();

            $table->foreign('volunteer_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }
};