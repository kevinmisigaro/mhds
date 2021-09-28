<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboards\CustomerDashboardController;
use App\Http\Controllers\Dashboards\AdminDashboardController;
use App\Http\Controllers\Dashboards\InsuranceDashboardController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Livewire\PrescriptionDetails;

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


    Route::post('/prescriptions/store',[PrescriptionController::class, 'storePrescription']);



    Route::prefix('dashboard/insurer')->group(function(){
        Route::get('home',[InsuranceDashboardController::class,'index']);
        Route::get('prescriptions',[InsuranceDashboardController::class,'displayPrescriptions']);
        Route::get('prescription/{id}',PrescriptionDetails::class);
        Route::get('customers',[InsuranceDashboardController::class,'displayCustomers']);
    });



    Route::prefix('dashboard/admin')->group(function(){
        Route::get('home',[AdminDashboardController::class,'index']);

        Route::get('customers',[AdminDashboardController::class,'getCustomers']);
        Route::get('customer/{id}',[AdminDashboardController::class,'displayCustomerDetails']);
        Route::get('customer/card/{id}',[AdminDashboardController::class,'displayCustomerCard']);
        Route::get('customer/approvecard/{id}',[AdminDashboardController::class,'approveCard']);
        Route::get('customer/disapprovecard/{id}',[AdminDashboardController::class,'disapproveCard']);

        Route::get('prescriptions',[AdminDashboardController::class,'displayPrescriptions']);

        Route::get('insurers',[AdminDashboardController::class,'getInsurers']);
        Route::get('doctors',[AdminDashboardController::class,'getDoctors']);

        Route::get('companies',[AdminDashboardController::class,'displayInsuranceCompanies']);
        Route::post('company/sellingprice/update',[CompanyController::class,'updateSellingPrice']);

        Route::get('complaints',[AdminDashboardController::class,'displayComplaints']);
        Route::get('complaint-chat/{id}',[AdminDashboardController::class,'displayComplaintChat']);
        Route::post('sendComplaintChat',[AdminDashboardController::class,'sendComplaintMessage']);

        Route::get('stock',[StockController::class,'index']);
        Route::get('create/stock',[StockController::class,'create']);
        Route::post('stock/store',[StockController::class,'store']);
    });
    
    Route::get('logout', [AuthController::class, 'logout']);
});
