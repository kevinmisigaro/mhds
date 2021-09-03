<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsuranceCard;
use App\Models\Customer;
use App\Models\Complaint;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index(){
        $count = 0;

        $cards = InsuranceCard::where('owner_id', Auth::user()->id)->get();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $prescriptions = Prescription::where('patient_id', Auth::user()->id)->get();

        if($customer->profile_image != null){
            $count++;
        }

        if($customer->sex != null){
            $count++;
        }

        if($customer->dob != null){
            $count++;
        }
        
        $profileCount = $count/3;

        return view('dashboard.home',\compact('cards','profileCount','prescriptions'));
    }

    public function displayCards(){
        $cards = InsuranceCard::where('owner_id', Auth::user()->id)->with('company')->get();
        return view('dashboard.customer.cards', \compact('cards'));
    }

    public function displayCard($cardId){
        $card = InsuranceCard::where('id', $cardId)->with('company')->first();
        return view('dashboard.customer.card', \compact('card'));
    }

    public function displayPrescriptions(){
        $prescriptions = Prescription::where('patient_id', Auth::user()->id)->get();
        return \view('dashboard.customer.prescriptions', \compact('prescriptions'));
    }

    public function newComplaint(){
        return view('dashboard.customer.new-complaint');
    }

    public function newCard(){
        return view('dashboard.customer.new-card');
    }

    public function displayComplaints(){
        $checkIfComplaintsExists = Complaint::where('complainer', Auth::user()->id)->exists();

        if($checkIfComplaintsExists){
            $complaints = Complaint::where('complainer', Auth::user()->id)->get();
        } else{
            $complaints = [];
        }

        return view('dashboard.customer.complaints', \compact('complaints'));
    }
}
