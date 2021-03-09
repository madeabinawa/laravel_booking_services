<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    // LOGIN ROUTE
    Route::post('/login', [UserController::class, 'login']);

    // APPOINTMENT ROUTES
    Route::middleware('auth:sanctum')->prefix('appointments')->group(function () {
        Route::get('/', [AppointmentController::class, 'index']);
        Route::post('/store', [AppointmentController::class, 'store']);
        Route::get('/show/{id}', [AppointmentController::class, 'show']);
        Route::post('/update/{id}', [AppointmentController::class, 'update']);
        Route::post('/destroy/{id}', [AppointmentController::class, 'destroy']);
    });

    // CUSTOMER ROUTES
    Route::middleware('auth:sanctum')->prefix('customer')->group(function () {
        Route::get('/show', [UserController::class, 'show']);
        Route::post('/update', [UserController::class, 'update']);
        Route::post('/logout', [UserController::class, 'logout']);
    });
});
