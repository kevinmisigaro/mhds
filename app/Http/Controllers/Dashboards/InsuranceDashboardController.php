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
use App\Models\ComplaintConversation;
use App\Models\Stock;
use App\Models\Complaint;

class InsuranceDashboardController extends Controller
{
    public function index(){
        $prescriptions = Prescription::with('patient')->get();
        $companyIDs = InsuranceCompany::where('manager_id',Auth::id())->pluck('id');

        $cards = InsuranceCard::whereIn('company_id', $companyIDs)->get();

        return view('dashboard.home',\compact('prescriptions', 'cards'));
    }

    public function displayComplaints(){
        $complaints = Complaint::where('complaint_type', 1)->with('complainerDetails')->get();
        return view('dashboard.insurer.complaints',\compact('complaints'));
    }

    public function displayComplaintChat($id){
        $conversation = ComplaintConversation::where('complaint_id',$id)->get();

        $convoId = ComplaintConversation::where('complaint_id',$id)->pluck('id')->first(); 

        $complaint = Complaint::where('id',$id)->first();

        return view('dashboard.insurer.complaint-chat',\compact('conversation','convoId','complaint'));
    }

    public function sendComplaintMessage(Request $request){

        $sampleconvo = ComplaintConversation::where('id',$request->convoId)->first(); 

        $convo = new ComplaintConversation;
        $convo->complaint_id = $sampleconvo->complaint_id;
        $convo->sender_id = Auth::user()->id;
        $convo->sender_is_read = false;
        $convo->reciever_is_read = true;
        $convo->message = $request->message;

        if($convo->save()){
            return \redirect()->back();
        }
    }

    public function displayPrescriptions(){
        $prescriptions = Prescription::where('approved_by_admin',true)->with('patient')->get();
        return view('dashboard.insurer.prescriptions',\compact('prescriptions'));
    }

    public function displayPrescriptionDetails($id){
        $prescription = Prescription::with(['patient','card'])->first();
        $stock = Stock::all();

        return view('dashboard.insurer.prescription-details',\compact('prescription','stock'));
    }

    public function displayCustomers(){
        $companyIDs = InsuranceCompany::where('manager_id',Auth::id())->pluck('id');
        $cards = InsuranceCard::whereIn('company_id', $companyIDs)->with('owner')->get();

        return view('dashboard.insurer.customers',\compact('cards'));
    }
}