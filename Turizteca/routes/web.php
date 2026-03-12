<?php

use Illuminate\Support\Facades\Route;


// Login
Route::view('/login', 'auth.login')->name('login');

// Dashboard
Route::middleware(['auth', 'can:access-admin'])->prefix('admin')->group(function () {

    Route::view('/', 'admin.overview')->name('admin');
    Route::view('/restaurants', 'admin.restaurants')->name('admin.restaurants');
    Route::view('/sponsorships', 'admin.sponsorships')->name('admin.sponsorships');
    Route::view('/reviews', 'admin.reviews')->name('admin.reviews');
    Route::view('/users', 'admin.users')->name('admin.users');
    Route::view('/settings', 'admin.settings')->name('admin.settings');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
