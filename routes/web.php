<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboards\CustomerDashboardController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [AuthController::class, 'showRegister']);
Route::get('/login',function(){
    return view('auth.login');
});

Route::get('/terms', function(){
    return view('terms');
});

Route::middleware('auth')->group(function () {

    Route::prefix('dashboard/customer')->group(function () {
        Route::get('home', [CustomerDashboardController::class,'index']);
        Route::get('cards', [CustomerDashboardController::class,'displayCards']);
        Route::get('card/{cardId}',[CustomerDashboardController::class,'displayCard']);
        Route::get('complaints',[CustomerDashboardController::class,'displayComplaints']);
        Route::get('new-complaint',[CustomerDashboardController::class,'newComplaint']);
        Route::get('prescriptions',[CustomerDashboardController::class,'displayPrescriptions']);
        Route::get('new-prescription', function(){
            return view('dashboard.new-prescription');
        });
    });
    
    Route::get('logout', [AuthController::class, 'logout']);
});
