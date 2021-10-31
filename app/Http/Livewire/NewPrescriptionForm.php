<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;
use App\Models\InsuranceCard;
use App\Rules\CardIsValid;
use App\Models\InsuranceCompany;

class NewPrescriptionForm extends Component
{
    use WithFileUploads;

    public $photo;
    public $cards;
    public $card;
    public $canSubmit = 1;
    public $companies;
    public $company;
    public $clinic;

    public function mount(){
        $this->cards = InsuranceCard::where('owner_id',Auth::user()->id)->with('company')->get();
        $this->companies = InsuranceCompany::all();
    }

    protected function rules(){
        return [
            'photo' => 'required',
            'card' => ['required','integer', new CardIsValid],
            'clinic' => 'required',
            'company' => 'required'
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->validate();
        $this->canSubmit = 2;
    }

    public function submit()
    {
        $this->canSubmit = 3;

        $this->validate();
 
        $path = $this->photo->store('prescriptions','public');

        $prescription = new Prescription;
        $prescription->image = '/storage/'.$path;
        $prescription->card_id = $this->card;
        $prescription->patient_id = Auth::user()->id;
        $prescription->company_id = $this->company;
        $prescription->hospital_name = $this->clinic;
        $prescription->save();

        $this->canSubmit = 1;

        session()->flash('message', 'Prescription successfully saved.');

        return \redirect('/dashboard/customer/prescriptions');

    }

    public function render()
    {
        return view('livewire.new-prescription-form');
    }
}
