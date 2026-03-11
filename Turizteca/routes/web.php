<?php
use Illuminate\Support\Facades\Route;

// Login
Route::view('/login', 'auth.login')->name('login');

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::view('/', 'admin.overview')->name('dashboard');
    Route::view('/restaurants', 'admin.restaurants')->name('admin.restaurants');
    Route::view('/sponsorships', 'admin.sponsorships')->name('admin.sponsorships');
    Route::view('/reviews', 'admin.reviews')->name('admin.reviews');
    Route::view('/users', 'admin.users')->name('admin.users');
    Route::view('/settings', 'admin.settings')->name('admin.settings');
});

Route::redirect('/', '/dashboard');
