<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;
use App\Models\InsuranceCard;
use App\Rules\CardIsValid;

class NewPrescriptionForm extends Component
{
    use WithFileUploads;

    public $photo;
    public $cards;
    public $card;
    public $canSubmit = 1;

    public function mount(){
        $this->cards = InsuranceCard::where('owner_id',Auth::user()->id)->with('company')->get();
    }

    protected function rules(){
        return [
            'photo' => 'required|image',
            'card' => ['required','integer', new CardIsValid],
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
 
        $path = $this->photo->store('prescriptions');

        $prescription = new Prescription;
        $prescription->image = $path;
        $prescription->card_id = $this->card;
        $prescription->patient_id = Auth::user()->id;
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
