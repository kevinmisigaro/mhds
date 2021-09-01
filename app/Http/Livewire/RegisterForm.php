<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\InsuranceCompany;
use App\Models\InsuranceCard;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterForm extends Component
{
    public $companies;
    public $registerformloading;

    public $name;
    public $email;
    public $company;
    public $card;
    public $password;
    public $confirmpassword;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email|unique:users,email',
        'company' => 'required',
        'card' => 'required',
        'password' => 'required|min:6',
        'confirmpassword' => 'required|min:6'
    ];

    public function submit(){
        $this->validate();

        $user = new User;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();

        $customer = new Customer;
        $customer->user_id = $user->id;
        $customer->save();

        $card = new InsuranceCard;
        $card->owner_id = $user->id;
        $card->company_id = $this->company;
        $card->type = 'Health';
        $card->insurance_number = $this->card;
        $card->save();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect('/dashboard/customer/home');
        }
    }

    public function mount(){
        $this->companies = InsuranceCompany::get();
        $this->registerformloading = false;
    }

    public function render()
    {
        return view('livewire.register-form');
    }
}
