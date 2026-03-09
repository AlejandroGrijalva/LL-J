<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SponsorshipsSeeder extends Seeder
{
    public function run(): void
    {
        $restaurantIds = DB::table('restaurants')->pluck('id');

        // Randomly sponsor 10 restaurants
        foreach ($restaurantIds->random(10) as $restaurantId) {
            DB::table('sponsorships')->insert([
                'restaurant_id' => $restaurantId,
                'visibility_level' => rand(1, 3),
                'label' => 'Patrocinado',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}