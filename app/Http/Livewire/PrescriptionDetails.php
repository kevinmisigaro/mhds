<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Models\StockBatch;
use Livewire\Component;
use App\Models\Prescription;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PrescriptionDetails as Details;
use App\Models\Delivery;

class PrescriptionDetails extends Component
{
    public $prescription;
    public $stock;

    public $drug;
    public $price;
    public $quantity;
    public $comment;

    public $prescriptionDetails;
    

    public function mount($id){
        $this->prescription = Prescription::where('id', $id)->with(['patient','card'])->first();
        $this->stock = Stock::has('batches')->get();
        $this->prescriptionDetails =  Details::where('prescription_id', $id)->with('drug')->get();
    }

    protected $rules = [
        'drug' => 'required',
        'price' => 'required',
        'quantity' => 'required'
    ];

    public function updatedDrug()
    {
        $value = Stock::where('id', $this->drug)->first();

        $margin = InsuranceCompany::where('id', $this->prescription->card->company_id)->pluck('margin')->first();

        $batch = StockBatch::where('stock_id', $value->id)->orderBy('created_at', 'desc')->first();

        $this->price = $batch->purchase_price * $margin;
    }

    public function deleteDrug($id){
        //get prescription details of specific drug
        $details = Details::where('id', $id)->with('drug')->first();

        //get batch id
        $batch = StockBatch::where('stock_id', $details->drug->id)->first();

        //return quantity of batch
        $batch->update([
            'quantity' => $batch->quantity + $details->quantity
        ]);

        //delete drug from prescription
        $details->delete();
    }

    public function submit()
    {
        $this->validate();

        DB::beginTransaction();

        try{
            $p = new Details;
            $p->prescription_id = $this->prescription->id;
            $p->drug_id = $this->drug;
            $p->selling_price = $this->price;
            $p->quantity = (int)$this->quantity;
            $p->save();

            $currentStock = StockBatch::where('stock_id', $p->drug_id)->first();
            $currentStock->quantity = $currentStock->quantity - (int)$this->quantity;

            if($currentStock->quantity < 0){
                return session()->flash('message', 'Please reduce quantity');
            }
            $currentStock->save();
             
            DB::commit();

        } catch (\Exception $e){
            DB::rollback();
            return session()->flash('message', 'An error has occurred');
        }

    }

    public function insurerReject(){
        $this->prescription->update([
            'approved_by_insurer' => false,
            'insurance_comment' => $this->comment
        ]); 

        return \redirect('/dashboard/insurer/prescriptions');
    }

    public function insurerApprove(){
        $this->prescription->update([
            'approved_by_insurer' => true,
            'insurance_comment' => $this->comment
        ]); 

        $values = Details::where('prescription_id', $this->prescription->id)->get();
        
        $actualAmount = 0;

        foreach ($values as $key => $value) {
            $actualAmount = $actualAmount + ( $value->selling_price * $value->quantity );
        }

        Delivery::create([
            'prescription_id' => $this->prescription->id,
            'total_amount' => $actualAmount,
            'approved_amount' => $actualAmount
        ]);

        return \redirect('/dashboard/insurer/prescriptions');
    }

    public function approve(){

        $this->prescription->update([
            'approved_by_admin' => true
        ]); 

        return \redirect('/dashboard/admin/prescriptions');
    }

    public function disapprove(){
        $this->prescription->update([
            'approved_by_admin' => false
        ]); 

        return \redirect('/dashboard/admin/prescriptions');
    }

    public function render()
    {
        return view('dashboard.insurer.prescription-details')
        ->layout('layouts.dashboard', ['title' => 'Prescription details']);
    }
}
