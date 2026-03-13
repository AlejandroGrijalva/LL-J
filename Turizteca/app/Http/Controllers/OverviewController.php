<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Sponsorship;
use App\Models\User;

class OverviewController extends Controller
{
    public function index()
    {
        $totalRestaurants   = Restaurant::count();
        $activeSponsorships = Sponsorship::count();
        $averageRating      = Review::avg('rating');
        $registeredUsers    = User::count();

        return view('admin.overview', compact(
            'totalRestaurants',
            'activeSponsorships',
            'averageRating',
            'registeredUsers'
        ));
    }
}
