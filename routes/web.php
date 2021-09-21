<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboards\CustomerDashboardController;
use App\Http\Controllers\Dashboards\AdminDashboardController;
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
        Route::get('new-card',[CustomerDashboardController::class,'newCard']);
        Route::get('updateCard/{cardId}',[CustomerDashboardController::class,'displayUpdateCard']);
        Route::post('updateCard',[CustomerDashboardController::class,'updateCard']);

        Route::get('complaints',[CustomerDashboardController::class,'displayComplaints']);
        Route::get('new-complaint',[CustomerDashboardController::class,'newComplaint']);
        Route::get('complaint-chat/{id}',[CustomerDashboardController::class,'displayComplaintChat']);
        Route::post('sendComplaintChat',[CustomerDashboardController::class,'sendComplaintMessage']);
        Route::get('closeComplaint/{id}',[CustomerDashboardController::class,'closeComplaint']);

        Route::get('prescriptions',[CustomerDashboardController::class,'displayPrescriptions']);
        Route::get('new-prescription', function(){
            return view('dashboard.customer.new-prescription');
        });

        Route::get('profile',[CustomerDashboardController::class,'displayProfile']);
    });

    Route::prefix('dashboard/admin')->group(function(){
        Route::get('home',[AdminDashboardController::class,'index']);

        Route::get('customers',[AdminDashboardController::class,'getCustomers']);
        Route::get('customer/{id}',[AdminDashboardController::class,'displayCustomerDetails']);

        Route::get('insurers',[AdminDashboardController::class,'getInsurers']);
        Route::get('doctors',[AdminDashboardController::class,'getDoctors']);
        Route::get('companies',[AdminDashboardController::class,'displayInsuranceCompanies']);
        Route::get('complaints',[AdminDashboardController::class,'displayComplaints']);
        Route::get('complaint-chat/{id}',[AdminDashboardController::class,'displayComplaintChat']);
        Route::post('sendComplaintChat',[AdminDashboardController::class,'sendComplaintMessage']);
    });
    
    Route::get('logout', [AuthController::class, 'logout']);
});
