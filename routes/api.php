<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BvnVerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('v1.0/user')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Routes protected by Sanctum middleware
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('initiate_bvn', [BvnVerificationController::class, 'initiate_bvn']);
        Route::post('verify_otp', [BvnVerificationController::class, 'verify_otp']);
    });
});

Route::any('{any}', function () {
    return failed('Route not found',[], \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
})->where('any', '.*');
