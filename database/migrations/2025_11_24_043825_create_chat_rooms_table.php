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
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();

            $table->string('room_name');
            $table->text('description')->nullable();

            // public / private
            $table->string('type')->default('public');

            // Who created the room
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');

            // Whether non-admins can invite others
            $table->boolean('invite_permission')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
};
