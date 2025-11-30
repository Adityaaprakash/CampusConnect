<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Basic user details
            $table->string('name');
            $table->string('email')->unique();
            
            // Password (hashed)
            $table->string('password');

            // Role: admin / student
            $table->string('role')->default('student');

            // Credit points
            $table->integer('credits')->default(0);

            // Token for remember_me login
            $table->rememberToken();

            // Email verification (for future use)
            $table->timestamp('email_verified_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
