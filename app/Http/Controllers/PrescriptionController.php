<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrescriptionDetails;
use Illuminate\Support\Facades\Validator;
use App\Models\Prescription;
use App\Models\Delivery;
use App\Models\StockBatch;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

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
        Delivery::where('id', $id)->update([
            'dispatched_by_sp' => true
        ]);

        session()->flash('message', 'Prescription dispatched');

        return \redirect()->back();
    }

    public function printInvoice($id){
        $deliveryTracking = Delivery::where('id', $id)->with('prescription')->first();

        //start generating invoice
        $client = new Party([
            'name' => $deliveryTracking->prescription->company->manager->name,
            'email' => $deliveryTracking->prescription->company->manager->email
        ]);

        $customer = new Party([
            'name' => env('APP_NAME'),
            'email' => 'info@gusa.co.tz'
        ]);

        $items = [];

        foreach ($deliveryTracking->prescription->details as $detail) {
           array_push($items, ( new InvoiceItem())
                                    ->title($detail->drug->generic_name) 
                                    ->pricePerUnit($detail->selling_price)
                                    ->quantity($detail->quantity)
                                );
        }

        $notes = [
            'Payment Info:',
            'Exim Bank (T) Ltd',
            'Account Number: 0320002470',
            'Account Name: Melian Software Company Limited'
        ];
        $notes = implode("<br>", $notes);


        $invoice = Invoice::make('invoice')->seller($customer)->buyer($client)
                        ->date(now())->dateFormat('d/m/Y')->payUntilDays(15)
                        ->currencySymbol('TZS')->currencyCode('TZS')
                        ->currencyFormat('{VALUE}{SYMBOL}')->currencyThousandsSeparator('.')
                        ->currencyDecimalPoint(',')->filename($client->name . ' invoice from ' . $customer->name)
                        ->addItems($items)->notes($notes);

        return $invoice->download();
    }

    public function invoice($id){
        Delivery::where('id', $id)->with('prescription')->update([
            'invoice_generated' => true
        ]);

        session()->flash('message', 'Invoice generated');

        return \redirect()->back();
    }

    public function deliveryAcceptance($id){
        Delivery::where('id', $id)->update([
            'customer_delivery_accept' => true
        ]);

        session()->flash('message', 'Delivery accepted');

        return \redirect()->back();
    }

    public function processPayment($id){
        Delivery::where('id', $id)->update([
            'insurer_process_payment' => true
        ]);

        session()->flash('message', 'Payment process started');

        return \redirect()->back();
    }

    public function confirmPayment($id){
        Delivery::where('id', $id)->update([
            'sp_confirm_payment' => true
        ]);

        session()->flash('message', 'Payment confirmed');

        return \redirect()->back();
    }

    public function editPrescriptionDrug(Request $request){
        $details = PrescriptionDetails::where('id', $request->id)->with('drug')->first();

        $batch = StockBatch::where('stock_id', $details->drug->id)->first();

        $batch->update([
            'quantity' => $batch->quantity + $details->quantity
        ]);
        
        $details->update([
            'selling_price' =>$request->price,
            'quantity' => $request->quantity
        ]);

        $batch->update([
            'quantity' => $batch->quantity - $request->quantity
        ]);

        return \redirect()->back();
    }

}
