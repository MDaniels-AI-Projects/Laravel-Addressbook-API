<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// This one line creates the URLs for Create, Read, Update, and Delete!
Route::apiResource('contacts', ContactController::class);