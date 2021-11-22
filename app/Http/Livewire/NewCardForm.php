<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\InsuranceCard;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Auth;

class NewCardForm extends Component
{
    use WithFileUploads;

    public $cardNumber;
    public $company;
    public $image;
    public $companies;

    public function mount(){
        $this->companies = InsuranceCompany::get();
    }

    protected $rules = [
        'cardNumber' => 'required',
        'company' => 'required|integer',
        'image' => 'required|image'
    ];

    public function submit(){
        $this->validate();

        $card = new InsuranceCard;
        $card->insurance_number = $this->cardNumber;
        $card->owner_id = Auth::user()->id;
        $card->company_id = $this->company;
        $card->type = 'Health';
        $card->image = $this->image->store('cards',['disk' => 'public']);
        $card->save();

        session()->flash('message', 'Card successfully saved.');
        return \redirect('/dashboard/customer/cards');
    }

    public function render()
    {
        return view('livewire.new-card-form');
    }
}
