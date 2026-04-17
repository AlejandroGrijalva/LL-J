<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/user_cuisines',\App\Http\Controllers\Api\UserCuisinesAPIController::class);
Route::apiResource('/users',\App\Http\Controllers\Api\UsersAPIController::class);
Route::apiResource('/sponsorships',\App\Http\Controllers\Api\SponsorshipsAPIController::class);
Route::apiResource('/restaurants',\App\Http\Controllers\Api\RRestaurantsAPIController::class);
Route::apiResource('/reviews',\App\Http\Controllers\Api\ReviewsAPIController::class);
