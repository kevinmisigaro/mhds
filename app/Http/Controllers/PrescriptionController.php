<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrescriptionDetails;
use Illuminate\Support\Facades\Validator;
use App\Models\Prescription;
use App\Models\Delivery;

class PrescriptionController extends Controller
{
    public function storePrescription(Request $request){

        $validator = Validator::make($request->all(), [
            'drug' => 'required',
            'price' => 'required',
            'id' => 'required',
            'quantity' => 'required'
        ]);

        $p = new PrescriptionDetails;
        $p->prescription_id = $request->id;
        $p->drug_id = $request->drug;
        $p->selling_price = $request->price;
        $p->quantity = $request->quantity;
        $p->save();

        return \redirect('/dashboard/insurer/prescription/'. $request->id);
    }

    public function tracking($id){
        $checkIfTrackingExists = Delivery::where('prescription_id', $id)->with('prescription')->exists();

        if($checkIfTrackingExists){
            $tracking = Delivery::where('prescription_id', $id)->with('prescription')->first();
            return view('/dashboard/admin/delivery-tracking', \compact('tracking'));
        }

        $tracking = [];
        return view('/dashboard/admin/delivery-tracking', \compact('tracking'));
    }

    public function dispatchPrescription($id){
        Delivery::where('prescription_id', $id)->update([
            'dispatched_by_sp' => true
        ]);

        session()->flash('message', 'Prescription dispatched');

        return \redirect()->back();
    }

    public function invoice($id){
        Delivery::where('prescription_id', $id)->update([
            'invoice_generated' => true
        ]);

        //generate invoice code

        session()->flash('message', 'Invoice generated');

        return \redirect()->back();
    }

    public function deliveryAcceptance($id){
        Delivery::where('prescription_id', $id)->update([
            'customer_delivery_accept' => true
        ]);

        session()->flash('message', 'Delivery accepted');

        return \redirect()->back();
    }

    public function processPayment($id){
        Delivery::where('prescription_id', $id)->update([
            'insurer_process_payment' => true
        ]);

        session()->flash('message', 'Payment process started');

        return \redirect()->back();
    }

    public function confirmPayment($id){
        Delivery::where('prescription_id', $id)->update([
            'sp_confirm_payment' => true
        ]);

        session()->flash('message', 'Payment confirmed');

        return \redirect()->back();
    }

}
