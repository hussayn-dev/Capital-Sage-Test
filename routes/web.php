<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BvnVerificationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'home']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});

// Grouped Routes with Middleware 'web'
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Route
    Route::get('/dashboard', [PageController::class, 'dashboard'])
                     ->middleware('bvn_verified')->name('dashboard');

    // BVN Initiate Routes
    Route::get('/bvn/initiate', [BvnVerificationController::class, 'bvn_initiate'])->name('bvn.initiate');
    Route::post('/bvn/initiate', [BvnVerificationController::class, 'initiate_bvn'])->name('bvn.initiate.submit');

    // BVN Verify Routes
    Route::get('/bvn/verify', [BvnVerificationController::class, 'bvn_verify'])->name('bvn.verify');
    Route::post('/bvn/verify', [BvnVerificationController::class, 'verify_bvn'])->name('bvn.verify.submit');


});
