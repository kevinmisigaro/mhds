<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InsuranceCompany;
use App\Models\Complaint;

class AdminDashboardController extends Controller
{
    public function index(){
        $customers = User::where('role','customer')->get();
        $insurers = User::where('role','insurer')->get();
        $doctors = User::where('role','doctor')->get();
        $companies = InsuranceCompany::get();

        return view('dashboard.home',\compact('customers','insurers','doctors','companies'));
    }

    public function getCustomers(){
        $customers = User::where('role','customer')->with('customer')->get();
        return view('dashboard.admin.customers',\compact('customers'));
    }

    public function getInsurers(){
        $insurers = User::where('role','insurer')->get();
        return view('dashboard.admin.insurers',\compact('insurers'));
    }

    public function getDoctors(){
        $doctors = User::where('role','doctor')->get();
        return view('dashboard.admin.doctors',\compact('doctors'));
    }

    public function displayInsuranceCompanies(){
        $companies = InsuranceCompany::with('manager')->get();
        return view('dashboard.admin.insurance-companies',\compact('companies'));
    }

    public function displayComplaints(){
        $complaints = Complaint::with('complainerDetails')->get();
        return view('dashboard.admin.complaints',\compact('complaints'));
    }
}
