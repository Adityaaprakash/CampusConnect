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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();

            // Basic property info
            $table->string('title');
            $table->integer('rent'); // monthly rent in rupees
            $table->string('location');
            $table->string('full_address')->nullable();

            // Details
            $table->text('description')->nullable();

            // JSON/text field to store amenities list (Wi-Fi, food, AC, etc.)
            $table->text('amenities')->nullable();

            // Owner / agent
            $table->string('owner_name');
            $table->string('phone');

            // Who created this listing (student or admin)
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');

            // Pricing/availability meta
            $table->integer('deposit')->nullable();
            $table->string('availability_status')->default('available'); // available / occupied / upcoming

            // Whether admin has approved the listing
            $table->boolean('approved')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
