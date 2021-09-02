<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;

class NewPrescriptionForm extends Component
{
    use WithFileUploads;

    public $photo;

    public function submit()
    {
        $this->validate([
            'photo' => 'image',
        ]);
 
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
