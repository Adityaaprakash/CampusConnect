<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Restaurant 1: Campus Cafe
        $cafe = Restaurant::create([
            'name' => 'Campus Cafe',
            'location' => 'Near Library Block',
            'image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&h=600&fit=crop',
        ]);

        MenuItem::insert([
            ['restaurant_id' => $cafe->id, 'item' => 'Masala Dosa', 'price' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $cafe->id, 'item' => 'Plain Dosa', 'price' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $cafe->id, 'item' => 'Idli Sambar', 'price' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $cafe->id, 'item' => 'Vada', 'price' => 40, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $cafe->id, 'item' => 'Coffee', 'price' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $cafe->id, 'item' => 'Tea', 'price' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $cafe->id, 'item' => 'Sandwich', 'price' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $cafe->id, 'item' => 'Poha', 'price' => 45, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Restaurant 2: Spice Garden
        $spiceGarden = Restaurant::create([
            'name' => 'Spice Garden',
            'location' => 'Main Canteen Area',
            'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&h=600&fit=crop',
        ]);

        MenuItem::insert([
            ['restaurant_id' => $spiceGarden->id, 'item' => 'Biryani (Chicken)', 'price' => 150, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $spiceGarden->id, 'item' => 'Biryani (Veg)', 'price' => 120, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $spiceGarden->id, 'item' => 'Butter Chicken', 'price' => 180, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $spiceGarden->id, 'item' => 'Dal Makhani', 'price' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $spiceGarden->id, 'item' => 'Paneer Butter Masala', 'price' => 140, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $spiceGarden->id, 'item' => 'Naan', 'price' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $spiceGarden->id, 'item' => 'Roti', 'price' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $spiceGarden->id, 'item' => 'Rice', 'price' => 40, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Restaurant 3: Pizza Corner
        $pizzaCorner = Restaurant::create([
            'name' => 'Pizza Corner',
            'location' => 'Student Center',
            'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=800&h=600&fit=crop',
        ]);

        MenuItem::insert([
            ['restaurant_id' => $pizzaCorner->id, 'item' => 'Margherita Pizza', 'price' => 200, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $pizzaCorner->id, 'item' => 'Pepperoni Pizza', 'price' => 250, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $pizzaCorner->id, 'item' => 'Veg Supreme Pizza', 'price' => 230, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $pizzaCorner->id, 'item' => 'Chicken Pizza', 'price' => 270, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $pizzaCorner->id, 'item' => 'Garlic Bread', 'price' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $pizzaCorner->id, 'item' => 'French Fries', 'price' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $pizzaCorner->id, 'item' => 'Cold Drink', 'price' => 40, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Restaurant 4: Chinese Express
        $chineseExpress = Restaurant::create([
            'name' => 'Chinese Express',
            'location' => 'Food Court',
            'image' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&h=600&fit=crop',
        ]);

        MenuItem::insert([
            ['restaurant_id' => $chineseExpress->id, 'item' => 'Veg Noodles', 'price' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $chineseExpress->id, 'item' => 'Chicken Noodles', 'price' => 130, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $chineseExpress->id, 'item' => 'Veg Fried Rice', 'price' => 110, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $chineseExpress->id, 'item' => 'Chicken Fried Rice', 'price' => 140, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $chineseExpress->id, 'item' => 'Manchurian (Veg)', 'price' => 120, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $chineseExpress->id, 'item' => 'Manchurian (Chicken)', 'price' => 150, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $chineseExpress->id, 'item' => 'Spring Rolls', 'price' => 80, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Restaurant 5: South Indian Delight
        $southIndian = Restaurant::create([
            'name' => 'South Indian Delight',
            'location' => 'Near Hostel Block',
            'image' => 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=800&h=600&fit=crop',
        ]);

        MenuItem::insert([
            ['restaurant_id' => $southIndian->id, 'item' => 'Rava Dosa', 'price' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $southIndian->id, 'item' => 'Onion Dosa', 'price' => 85, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $southIndian->id, 'item' => 'Uttapam', 'price' => 75, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $southIndian->id, 'item' => 'Pongal', 'price' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $southIndian->id, 'item' => 'Upma', 'price' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $southIndian->id, 'item' => 'Rava Idli', 'price' => 55, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $southIndian->id, 'item' => 'Filter Coffee', 'price' => 35, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Restaurant 6: Burger House
        $burgerHouse = Restaurant::create([
            'name' => 'Burger House',
            'location' => 'Main Gate Area',
            'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=800&h=600&fit=crop',
        ]);

        MenuItem::insert([
            ['restaurant_id' => $burgerHouse->id, 'item' => 'Veg Burger', 'price' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $burgerHouse->id, 'item' => 'Chicken Burger', 'price' => 120, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $burgerHouse->id, 'item' => 'Cheese Burger', 'price' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $burgerHouse->id, 'item' => 'French Fries', 'price' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $burgerHouse->id, 'item' => 'Chicken Wings', 'price' => 150, 'created_at' => now(), 'updated_at' => now()],
            ['restaurant_id' => $burgerHouse->id, 'item' => 'Milk Shake', 'price' => 60, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
