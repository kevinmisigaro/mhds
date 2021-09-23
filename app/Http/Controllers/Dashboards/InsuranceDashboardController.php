<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InsuranceCompany;
use App\Models\Prescription;
use App\Models\PrescriptionDetails;
use Illuminate\Support\Facades\Auth;
use App\Models\InsuranceCard;

class InsuranceDashboardController extends Controller
{
    public function index(){
        $prescriptions = Prescription::with('patient')->get();
        $companyIDs = InsuranceCompany::where('manager_id',Auth::id())->pluck('id');

        $cards = InsuranceCard::whereIn('company_id', $companyIDs)->get();

        return view('dashboard.home',\compact('prescriptions', 'cards'));
    }

    public function displayPrescriptions(){
        $prescriptions = Prescription::with('patient')->get();
        return view('dashboard.insurer.prescriptions',\compact('prescriptions'));
    }

    public function displayPrescriptionDetails($id){
        $prescription = Prescription::with(['patient','card'])->first();
        

        return view('dashboard.insurer.prescription-details',\compact('prescription'));
    }

    public function displayCustomers(){
        $companyIDs = InsuranceCompany::where('manager_id',Auth::id())->pluck('id');
        $cards = InsuranceCard::whereIn('company_id', $companyIDs)->with('owner')->get();

        return view('dashboard.insurer.customers',\compact('cards'));
    }
}