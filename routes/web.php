<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AssistantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// TO DASHBOARD AFTER LOGIN PAGE
Route::get('/', fn () => view('dashboard'))->middleware('auth');

// USER ROLE MANAGEMENT
Route::resource('admins', AdminController::class)->middleware('adminRoute');
Route::resource('managers', ManagerController::class)->middleware('adminRoute');
Route::resource('assistants', AssistantController::class)->middleware('assistantRoute');
Route::resource('customers', CustomerController::class)->middleware('customerRoute');

// ERROR UNAUTHORIZE VIEW
Route::get('/unauthorize', fn () => view('error.unauthorize'))->name('unauthorized');
