<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InsuranceCompany;
use App\Models\Complaint;
use App\Models\Prescription;
use App\Models\ComplaintConversation;
use Illuminate\Support\Facades\Auth;
use App\Models\InsuranceCard;

class AdminDashboardController extends Controller
{
    public function index(){
        $customers = User::where('role','customer')->get();
        $insurers = User::where('role','insurer')->get();
        $doctors = User::where('role','doctor')->get();
        $prescriptions = Prescription::get();
        $companies = InsuranceCompany::get();
        $complaints = Complaint::get();

        return view('dashboard.home',\compact('customers','insurers','doctors','companies','prescriptions','complaints'));
    }

    public function getCustomers(){
        $customers = User::where('role','customer')->with('customer')->get();
        $companies = InsuranceCompany::get();
        return view('dashboard.admin.customers',\compact('customers','companies'));
    }

    public function displayCustomerDetails($id){
        $customer = User::where('id',$id)->with(['customer','cards'])->first();
        return view('dashboard.admin.customer-details',\compact('customer'));
    }

    public function displayCustomerCard($id){
        $card = InsuranceCard::where('id', $id)->with(['company','owner'])->first();
        return view('dashboard.admin.customer-card',\compact('card'));
    }

    public function getInsurers(){
        $insurers = User::where('role','insurer')->with('insuranceCompanyManaged')->get();
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
        $complaints = Complaint::where('complaint_type', 1)->with('complainerDetails')->get();
        return view('dashboard.admin.complaints',\compact('complaints'));
    }

    public function displayComplaintChat($id){
        $conversation = ComplaintConversation::where('complaint_id',$id)->get();

        $convoId = ComplaintConversation::where('complaint_id',$id)->pluck('id')->first(); 

        $complaint = Complaint::where('id',$id)->first();

        return view('dashboard.admin.complaint-chat',\compact('conversation','convoId','complaint'));
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

    public function approveCard($id){
        $card = InsuranceCard::where('id',$id)->with('owner')->first();

        $card->update([
            'valid' => true
        ]);

        session()->flash('message', 'Card validated');

        return \redirect('/dashboard/admin/customer/'.$card->owner->id);
    }

    public function disapproveCard($id){
        $card = InsuranceCard::where('id',$id)->with('owner')->first();

        $card->update([
            'valid' => false
        ]);

        session()->flash('message', 'Card unvalidated.');

        return \redirect('/dashboard/admin/customer/'.$card->owner->id);
    }

    public function displayPrescriptions(){
        $prescriptions = Prescription::with('patient')->get();
        return view('dashboard.admin.prescriptions',\compact('prescriptions'));
    }
}
