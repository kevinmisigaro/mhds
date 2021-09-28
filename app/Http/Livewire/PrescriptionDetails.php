<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;
use App\Models\Prescription;
use App\Models\ProfitMargin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrescriptionDetails extends Component
{
    public $prescription;
    public $stock;

    public $drug;
    public $price;
    public $quantity;

    public function mount($id){
        $this->prescription = Prescription::where('id', $id)->with(['patient','card'])->first();
        $this->stock = Stock::all();
    }

    protected $rules = [
        'drug' => 'required',
        'price' => 'required',
        'quantity' => 'required'
    ];

    public function updatedDrug()
    {
        $value = Stock::where('id', $this->drug)->first();

        $margin = ProfitMargin::where('company_id', $this->prescription->card->company_id)->first();

        $this->price = $value->purchase_price * $margin->margin;
    }

    public function submit()
    {
        $this->validate();

        DB::beginTransaction();

        try{
            $p = new \App\Models\PrescriptionDetails;
            $p->prescription_id = $this->prescription->id;
            $p->drug_id = $this->drug;
            $p->selling_price = $this->price;
            $p->quantity = $this->quantity;
            $p->save();

            $currentStock = Stock::where('id', $this->drug)->first();
            $currentStock->quantity = $currentStock->quantity - $this->quantity;
            $currentStock->save();

        } catch (\Exception $e){
            DB::rollback();
            dd($e);
            // return \redirect()->back();
        }

    }

    public function approve(){

        if(Auth::user()->role == 'admin'){
            $this->prescription->update([
                'approved_by_manager' => true
            ]); 
        }

        if(Auth::user()->role == 'insurer'){
            $this->prescription->update([
                'approved_by_insurer' => true
            ]); 
        }

        return \redirect('/dashboard/admin/prescriptions');
    }


    public function disapprove(){
        if(Auth::user()->role == 'admin'){
            $this->prescription->update([
                'approved_by_manager' => false
            ]); 
        }

        if(Auth::user()->role == 'insurer'){
            $this->prescription->update([
                'approved_by_insurer' => false
            ]); 
        } 

        return \redirect('/dashboard/admin/prescriptions');
    }

    public function render()
    {
        return view('dashboard.insurer.prescription-details')
        ->layout('layouts.dashboard', ['title' => 'Prescription details']);
    }
}
