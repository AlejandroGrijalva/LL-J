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
            'asian','japanese','chinese','thai','indian','mediterranean','fast_food',
            'cafe','bakery','tacos','pizza','burgers','bar','fusion','local'
        ];

        $restaurants = [];

        for ($i = 1; $i <= 15; $i++) {

            $restaurants[] = [
                'id' => $i,
                'owner_id' => $faker->numberBetween(2,5), // mismo rango que tu código
                'name' => $faker->company . " Restaurant",
                'description' => $faker->sentence(10),
                'cuisine_type' => $faker->randomElement($cuisines),
                'average_price' => $faker->numberBetween(80,400),

                // mismas coordenadas aproximadas que tenías
                'location_lat' => 28 + ($faker->numberBetween(-100,100)/1000),
                'location_lng' => -107 + ($faker->numberBetween(-100,100)/1000),

                'opening_hours_type' => 'all_day',
                'opens_at' => null,
                'closes_at' => null
            ];
        }

        DB::table('restaurants')->insert($restaurants);
    }
}