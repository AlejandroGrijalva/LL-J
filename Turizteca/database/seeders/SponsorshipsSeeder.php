<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SponsorshipsSeeder extends Seeder {
    public function run(): void{
        $visibility = ['low','medium','high'];
        $recs = [];
    for($i=1;$i<=8;$i++){
        $recs[] = [
        'id'=>$i,
        'restaurant_id'=>$i,
        'visibility_level'=>$visibility[array_rand($visibility)],
        'label'=>'Patrocinado'
        ];
    }
  DB::table('sponsorships')->insert($recs);
 }
}
