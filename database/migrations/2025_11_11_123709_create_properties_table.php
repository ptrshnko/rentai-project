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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('address');
            $table->text('city')->nullable();
            $table->decimal('price_per_night', 12, 2);
            $table->integer('max_guests');
            $table->integer('beds')->nullable();
            $table->text('description')->nullable();
            $table->jsonb('attrs')->default('{}');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
