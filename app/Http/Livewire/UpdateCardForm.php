<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Auth;

class UpdateCardForm extends Component
{
    
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

    public function render()
    {
        return view('livewire.update-card-form', ['companies' => $this->companies]);
    }
}
