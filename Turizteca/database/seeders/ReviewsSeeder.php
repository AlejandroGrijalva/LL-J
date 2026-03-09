<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $restaurants = DB::table('restaurants')->pluck('id');
        $users = DB::table('users')->pluck('id');

        foreach ($restaurants as $restaurantId) {
            // Each restaurant gets 3–7 reviews
            $reviewCount = rand(3, 7);

            for ($i = 0; $i < $reviewCount; $i++) {
                DB::table('reviews')->insert([
                    'restaurant_id' => $restaurantId,
                    'user_id' => $users->random(),
                    'rating' => rand(1, 5),
                    'comment' => $faker->sentence(12),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
