<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCuisinesSeeder extends Seeder
{
    public function run(): void
    {
        $cuisines = [
            'mexican','seafood','italian','bbq','steakhouse','vegan','vegetarian',
            'asian','japanese','chinese','thai','indian','mediterranean',
            'fast_food','cafe','bakery','tacos','pizza','burgers','bar','fusion','local'
        ];

        $userIds = DB::table('users')->pluck('id');

        foreach ($userIds as $userId) {
            // Each user gets 2–4 favorite cuisines
            $selected = collect($cuisines)->random(rand(2, 4));

            foreach ($selected as $cuisine) {
                DB::table('user_cuisines')->insert([
                    'user_id' => $userId,
                    'cuisine' => $cuisine,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}