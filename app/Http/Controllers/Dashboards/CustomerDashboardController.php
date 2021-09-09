<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsuranceCard;
use App\Models\Customer;
use App\Models\Complaint;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\InsuranceCompany;

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

    public function displayUpdateCard($cardId){
        $card = InsuranceCard::where('id', $cardId)->with('company')->first();
        $companies = InsuranceCompany::get();

        return view('dashboard.customer.update-card', \compact('card', 'companies'));
    }

    public function updateCard(Request $request){   
        $card = InsuranceCard::where('id', $request->id)->with('company')->first();

        if($request->hasFile('image')){

            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storePubliclyAs(
                'images',
                $fileNameToStore,
                'public'
            );

            $card->update([
                'insurance_number' => $request->card,
                'company_id' => $request->company,
                'type' => $request->type,
                'image' => '/storage/'.$path
            ]);

        } else {
            $card->update([
                'insurance_number' => $request->card,
                'company_id' => $request->company,
                'type' => $request->type
            ]);
        }

        return \redirect('/dashboard/customer/card/'.$request->id);
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

    public function displayProfile(){
        $user = User::where('id', Auth::user()->id)->with('customer','cards')->first();

        return view('dashboard.customer.profile',compact('user'));
    }
}
