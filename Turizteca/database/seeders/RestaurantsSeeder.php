<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantsSeeder extends Seeder
{
    public function run(): void{
    $cuisines = ['mexican','seafood','italian','bbq','steakhouse','vegan','vegetarian','asian','japanese','chinese','thai','indian','mediterranean','fast_food','cafe','bakery','tacos','pizza','burgers','bar','fusion','local'];
    $restaurants = [];

    for($i=1;$i<=15;$i++){
        $restaurants[] = [
            'id'=>$i,
            'owner_id'=>rand(2,5), // owner accounts from users seeder
            'name'=>'Restaurant '.$i,
            'description'=>'A great place to eat and enjoy. Restaurant #'.$i,
            'cuisine_type'=>$cuisines[array_rand($cuisines)],
            'average_price'=>rand(80,400),
            'location_lat'=>28 + (rand(-100,100)/1000),
            'location_lng'=>-107 + (rand(-100,100)/1000),
            'opening_hours_type'=>'all_day',
            'opens_at'=>null,
            'closes_at'=>null
            ];
        }
        DB::table('restaurants')->insert($restaurants);
    }
}