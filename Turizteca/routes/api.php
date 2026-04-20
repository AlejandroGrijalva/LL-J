<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::put('/user', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/user_cuisines',\App\Http\Controllers\Api\UserCuisinesAPIController::class);
    Route::apiResource('/users',\App\Http\Controllers\Api\UsersAPIController::class);
    Route::apiResource('/sponsorships',\App\Http\Controllers\Api\SponsorshipsAPIController::class);
    Route::apiResource('/restaurants',\App\Http\Controllers\Api\RRestaurantsAPIController::class);
    Route::apiResource('/reviews',\App\Http\Controllers\Api\ReviewsAPIController::class);
});