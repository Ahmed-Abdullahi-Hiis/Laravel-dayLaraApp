<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Customer\CustomerPaymentController;

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/

Route::apiResource('blogs', BlogController::class);

/*
|--------------------------------------------------------------------------
| M-Pesa API Routes (Flutter + Safaricom)
|--------------------------------------------------------------------------
| These routes are PUBLIC.
| Do NOT protect them with auth middleware.
*/

// Flutter: Initiate STK Push
Route::post('/mpesa/stk-push', [
    CustomerPaymentController::class,
    'apiProcessPayment'
]);

// Flutter: Poll payment status
Route::get('/mpesa/status/{orderId}', [
    CustomerPaymentController::class,
    'apiPaymentStatus'
]);

// Safaricom: STK Callback (MUST be public)
Route::post('/customer/callback', [
    CustomerPaymentController::class,
    'mpesaCallback'
]);

/*
|--------------------------------------------------------------------------
| Protected API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\BlogController;
//Route::apiResource('blogs', BlogController::class);


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   // return $request->user();
//}); -->







