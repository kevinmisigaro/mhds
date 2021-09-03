<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;
use App\Models\InsuranceCard;

class NewPrescriptionForm extends Component
{
    use WithFileUploads;

    public $photo;
    public $cards;
    public $card;

    public function mount(){
        $this->cards = InsuranceCard::where('owner_id',Auth::user()->id)->with('company')->get();
    }

    public $rules = [
        'photo' => 'required|image',
        'card' => 'required'
    ];

    public function submit()
    {
        $this->validate();
 
        $path = $this->photo->store('prescriptions');

        $prescription = new Prescription;
        $prescription->image = $path;
        $prescription->patient_id = Auth::user()->id;
        $prescription->save();

        session()->flash('message', 'Prescription successfully saved.');

        return \redirect('/dashboard/customer/prescriptions');

    }

    public function render()
    {
        return view('livewire.new-prescription-form');
    }
}
