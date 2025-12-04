<?php

namespace Database\Seeders;

use App\Models\PropertyImage;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a default user for created_by
        $defaultUser = User::firstOrCreate(
            ['email' => 'admin@campusconnect.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // PG Listing 1
        $pg1 = Rent::create([
            'title' => 'Cozy PG for Boys - Near Campus',
            'rent' => 5000,
            'location' => 'Near College Gate',
            'full_address' => '123 Main Street, College Area, City - 123456',
            'description' => 'Well-maintained PG with clean rooms, perfect for students. Close to campus with easy access to public transport.',
            'amenities' => 'Wi-Fi, Food Available, AC, Geyser, Washing Machine, Power Backup',
            'owner_name' => 'Rajesh Kumar',
            'phone' => '9876543210',
            'created_by' => $defaultUser->id,
            'deposit' => 10000,
            'availability_status' => 'available',
            'approved' => true,
        ]);

        PropertyImage::create([
            'property_id' => $pg1->id,
            'image_path' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800&h=600&fit=crop',
        ]);

        // PG Listing 2
        $pg2 = Rent::create([
            'title' => 'Girls PG - Safe & Secure',
            'rent' => 6000,
            'location' => '5 minutes from Campus',
            'full_address' => '456 Park Avenue, Student Colony, City - 123456',
            'description' => 'Secure PG exclusively for girls with 24/7 security. Clean and hygienic environment with home-cooked meals.',
            'amenities' => 'Wi-Fi, Food Available, AC, Geyser, Washing Machine, CCTV, Security Guard',
            'owner_name' => 'Priya Sharma',
            'phone' => '9876543211',
            'created_by' => $defaultUser->id,
            'deposit' => 12000,
            'availability_status' => 'available',
            'approved' => true,
        ]);

        PropertyImage::create([
            'property_id' => $pg2->id,
            'image_path' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=600&fit=crop',
        ]);

        // PG Listing 3
        $pg3 = Rent::create([
            'title' => 'Budget-Friendly PG - Single Occupancy',
            'rent' => 4000,
            'location' => 'Near Hostel Block',
            'full_address' => '789 Hostel Road, Campus Area, City - 123456',
            'description' => 'Affordable PG with single occupancy rooms. Basic amenities included. Perfect for budget-conscious students.',
            'amenities' => 'Wi-Fi, Food Available, Geyser, Common Washing Area',
            'owner_name' => 'Amit Singh',
            'phone' => '9876543212',
            'created_by' => $defaultUser->id,
            'deposit' => 8000,
            'availability_status' => 'available',
            'approved' => true,
        ]);

        PropertyImage::create([
            'property_id' => $pg3->id,
            'image_path' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=800&h=600&fit=crop',
        ]);

        // Apartment Listing 1
        $apt1 = Rent::create([
            'title' => '2BHK Apartment - Sharing Available',
            'rent' => 12000,
            'location' => '10 minutes from Campus',
            'full_address' => '321 Green Park, Residential Area, City - 123456',
            'description' => 'Spacious 2BHK apartment available for sharing. Fully furnished with modern amenities. Looking for 2-3 roommates.',
            'amenities' => 'Wi-Fi, Fully Furnished, AC, Geyser, Washing Machine, Refrigerator, TV, Power Backup',
            'owner_name' => 'Vikram Mehta',
            'phone' => '9876543213',
            'created_by' => $defaultUser->id,
            'deposit' => 20000,
            'availability_status' => 'available',
            'approved' => true,
        ]);

        PropertyImage::create([
            'property_id' => $apt1->id,
            'image_path' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=800&h=600&fit=crop',
        ]);
        PropertyImage::create([
            'property_id' => $apt1->id,
            'image_path' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=600&fit=crop',
        ]);

        // Apartment Listing 2
        $apt2 = Rent::create([
            'title' => '1BHK Studio Apartment',
            'rent' => 8000,
            'location' => 'Near Shopping Complex',
            'full_address' => '654 Market Street, Commercial Area, City - 123456',
            'description' => 'Compact 1BHK studio apartment, fully furnished. Ideal for single occupancy. Close to markets and campus.',
            'amenities' => 'Wi-Fi, Fully Furnished, AC, Geyser, Washing Machine, Kitchen, Power Backup',
            'owner_name' => 'Sunita Reddy',
            'phone' => '9876543214',
            'created_by' => $defaultUser->id,
            'deposit' => 15000,
            'availability_status' => 'available',
            'approved' => true,
        ]);

        PropertyImage::create([
            'property_id' => $apt2->id,
            'image_path' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800&h=600&fit=crop',
        ]);

        // PG Listing 4 - Premium
        $pg4 = Rent::create([
            'title' => 'Premium PG - AC Rooms',
            'rent' => 8000,
            'location' => 'Prime Location - Near Campus',
            'full_address' => '987 Elite Avenue, Premium Colony, City - 123456',
            'description' => 'Premium PG with AC rooms, attached bathrooms, and premium amenities. Best-in-class facilities for comfortable living.',
            'amenities' => 'Wi-Fi, Food Available, AC, Geyser, Washing Machine, Refrigerator, TV, Power Backup, Housekeeping',
            'owner_name' => 'Rohit Agarwal',
            'phone' => '9876543215',
            'created_by' => $defaultUser->id,
            'deposit' => 16000,
            'availability_status' => 'available',
            'approved' => true,
        ]);

        PropertyImage::create([
            'property_id' => $pg4->id,
            'image_path' => 'https://images.unsplash.com/photo-1631889992176-3a97b74889d8?w=800&h=600&fit=crop',
        ]);
        PropertyImage::create([
            'property_id' => $pg4->id,
            'image_path' => 'https://images.unsplash.com/photo-1556912172-45b7abe8b7e1?w=800&h=600&fit=crop',
        ]);

        // PG Listing 5 - Upcoming
        $pg5 = Rent::create([
            'title' => 'New PG - Opening Soon',
            'rent' => 5500,
            'location' => 'Near Bus Stand',
            'full_address' => '147 Transit Road, Transport Hub, City - 123456',
            'description' => 'Brand new PG facility opening next month. Modern infrastructure with all latest amenities. Pre-booking available.',
            'amenities' => 'Wi-Fi, Food Available, AC, Geyser, Washing Machine, Power Backup, CCTV',
            'owner_name' => 'Neha Patel',
            'phone' => '9876543216',
            'created_by' => $defaultUser->id,
            'deposit' => 11000,
            'availability_status' => 'upcoming',
            'approved' => true,
        ]);

        PropertyImage::create([
            'property_id' => $pg5->id,
            'image_path' => 'https://images.unsplash.com/photo-1554995207-c18c203602cb?w=800&h=600&fit=crop',
        ]);

        // Apartment Listing 3 - Sharing
        $apt3 = Rent::create([
            'title' => '3BHK Apartment - Room Available',
            'rent' => 7000,
            'location' => '15 minutes from Campus',
            'full_address' => '258 Suburban Lane, Residential Zone, City - 123456',
            'description' => 'One room available in a 3BHK shared apartment. Currently 2 students living. Looking for a third roommate.',
            'amenities' => 'Wi-Fi, Fully Furnished, AC, Geyser, Washing Machine, Refrigerator, TV, Power Backup, Kitchen',
            'owner_name' => 'Anil Verma',
            'phone' => '9876543217',
            'created_by' => $defaultUser->id,
            'deposit' => 14000,
            'availability_status' => 'available',
            'approved' => true,
        ]);

        PropertyImage::create([
            'property_id' => $apt3->id,
            'image_path' => 'https://images.unsplash.com/photo-1560449752-91594c95b5a0?w=800&h=600&fit=crop',
        ]);
        PropertyImage::create([
            'property_id' => $apt3->id,
            'image_path' => 'https://images.unsplash.com/photo-1556911220-bff31c812dba?w=800&h=600&fit=crop',
        ]);
    }
}

