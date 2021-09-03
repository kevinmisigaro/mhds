<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index(){
        $customers = User::where('role','customer')->get();
        $insurers = User::where('role','insurer')->get();
        $doctors = User::where('role','doctor')->get();

        return view('dashboard.home',\compact('customers','insurers','doctors'));
    }

    public function getCustomers(){
        $customers = User::where('role','customer')->with('customer')->get();
        return view('dashboard.admin.customers',\compact('customers'));
    }
}
