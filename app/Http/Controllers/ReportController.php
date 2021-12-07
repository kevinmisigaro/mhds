<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prescription;
use App\Models\Complaint;
use App\Models\Stock;
use App\Models\PrescriptionDetails;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function admin(){
         
        $users = User::where('role', '<>', 1)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $prescriptions = Prescription::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $complaints = Complaint::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $drugs = Stock::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $details = PrescriptionDetails::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $amount = 0.0;

        foreach ($details as $key => $detail) {
            $amount += $detail->selling_price* $detail->quantity;
        }

        return view('dashboard.admin.reports', \compact('users','prescriptions','complaints','drugs','amount'));
    }

    public function insurer(){

        $prescriptions = [];
        $amount = 0.0;

        if (Prescription::where([
            'manager_id' => Auth::id(),
            'approved_by_insurer' => true
            ])->exists()) {
            
                $prescriptions = Prescription::where([
                    'manager_id' => Auth::id(),
                    'approved_by_insurer' => true
                    ])->with('details')->get();
        
                $amount = 0.0;
        
                foreach ($prescriptions->details as $key => $detail) {
                    $amount += $detail->selling_price * $detail->quantity;
                }

        } 

        return view('dashboard.insurer.reports', \compact('amount','prescriptions'));
    }
}
