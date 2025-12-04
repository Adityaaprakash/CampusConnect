<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            // Foreign key → restaurant_id
            $table->foreignId('restaurant_id')
                ->constrained('restaurants')
                ->onDelete('cascade');

            $table->string('item');     // Menu item name
            $table->integer('price');   // Menu item price
            $table->boolean('available')->default(true); // Availability status

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
