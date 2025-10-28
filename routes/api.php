<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

// Public API routes (no auth required)
Route::apiResource('blogs', BlogController::class);

// Protected API route (requires Sanctum auth)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
