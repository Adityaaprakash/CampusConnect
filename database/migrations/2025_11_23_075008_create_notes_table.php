<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            // User who uploaded the notes
            $table->unsignedBigInteger('user_id');

            // Note details
            $table->string('title');
            $table->string('department');
            $table->string('semester');
            $table->string('subject');
            $table->text('description')->nullable();

            // File information
            $table->string('file_name');

            // Approval status - pending / approved / rejected
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
}

