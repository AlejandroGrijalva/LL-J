<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RestaurantsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $cuisines = [
            'mexican','seafood','italian','bbq','steakhouse','vegan','vegetarian',
            'asian','japanese','chinese','thai','indian','mediterranean',
            'fast_food','cafe','bakery','tacos','pizza','burgers','bar','fusion','local'
        ];

        $openingTypes = [
            'all_day','breakfast_lunch','lunch_dinner','dinner_only',
            'weekdays_only','weekends_only','custom'
        ];

        // Generate 30 restaurants
        for ($i = 0; $i < 30; $i++) {
            DB::table('restaurants')->insert([
                'name' => $faker->company(),
                'description' => $faker->sentence(10),
                'cuisine_type' => $faker->randomElement($cuisines),
                'average_price' => $faker->numberBetween(100, 500),
                'location_lat' => $faker->latitude(28.0, 33.0),
                'location_lng' => $faker->longitude(-115.0, -100.0),
                'opening_hours_type' => $faker->randomElement($openingTypes),
                'opens_at' => '10:00:00',
                'closes_at' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}