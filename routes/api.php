<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Ensure this is here

// This is the "Login" route you need to add
Route::post('/login', [AuthController::class, 'login']);

// This is the "Protected" route to test if the token works
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});