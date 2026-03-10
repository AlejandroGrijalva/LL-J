<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            RestaurantsTableSeeder::class,
            SponsorshipsSeeder::class,
            ReviewsSeeder::class,
            UserCuisinesSeeder::class,
        ]);
    }
}
