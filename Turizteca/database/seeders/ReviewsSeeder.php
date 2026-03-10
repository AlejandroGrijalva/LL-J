<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsSeeder extends Seeder {
 public function run(): void{
  $reviews = [];
  for($i=1;$i<=40;$i++){
    $reviews[] = [
      'id'=>$i,
      'restaurant_id'=>rand(1,15),
      'user_id'=>rand(6,25), // customers
      'rating'=>strval(rand(1,5)),
      'comment'=>'This is a review comment #'.$i
    ];
  }
  DB::table('reviews')->insert($reviews);
 }
}

