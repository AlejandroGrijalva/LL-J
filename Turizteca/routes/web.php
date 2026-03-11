<?php
use Illuminate\Support\Facades\Route;

// Login
Route::view('/login', 'auth.login')->name('login');

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::view('/', 'dashboard.overview')->name('dashboard');
    Route::view('/restaurants', 'dashboard.restaurants')->name('dashboard.restaurants');
    Route::view('/sponsorships', 'dashboard.sponsorships')->name('dashboard.sponsorships');
    Route::view('/reviews', 'dashboard.reviews')->name('dashboard.reviews');
    Route::view('/users', 'dashboard.users')->name('dashboard.users');
    Route::view('/settings', 'dashboard.settings')->name('dashboard.settings');
});

Route::redirect('/', '/dashboard');
