<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCuisinesSeeder extends Seeder {
 public function run(): void{
  $cuisines = ['mexican','seafood','italian','bbq','steakhouse','vegan','vegetarian','asian','japanese','chinese','thai','indian','mediterranean','fast_food','cafe','bakery','tacos','pizza','burgers','bar','fusion','local'];
  $recs = [];
  $id=1;
  for($u=6;$u<=25;$u++){
    for($i=0;$i<2;$i++){
      $recs[] = ['id'=>$id,'user_id'=>$u,'cuisine'=>$cuisines[array_rand($cuisines)]];
      $id++;
    }
  }
  DB::table('user_cuisines')->insert($recs);
 }
}
