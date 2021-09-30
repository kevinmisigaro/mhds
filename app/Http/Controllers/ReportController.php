<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prescription;
use App\Models\Complaint;
use App\Models\Stock;
use App\Models\PrescriptionDetails;

class ReportController extends Controller
{
    public function admin(){
         
        $users = User::where('role', '<>', 'admin')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $prescriptions = Prescription::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $complaints = Complaint::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $drugs = Stock::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $details = PrescriptionDetails::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $amount = 0.0;

        foreach ($details as $key => $detail) {
            $amount += $detail->selling_price;
        }

        return view('dashboard.admin.reports', \compact('users','prescriptions','complaints','drugs','amount'));
    }
}
