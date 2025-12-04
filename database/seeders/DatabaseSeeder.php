<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the restaurant seeder
        $this->call(RestaurantSeeder::class);

        // Call the rent seeder
        $this->call(RentSeeder::class);

        // Create Student User
        \App\Models\User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@campusconnect.com',
            'password' => bcrypt('password'), // Default password
            'role' => 'student',
            'credits' => 100, // Give some initial credits
        ]);
    }
}
