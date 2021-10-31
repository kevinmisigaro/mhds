<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\InsuranceCompany;
use App\Models\InsuranceCard;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirm;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class RegisterForm extends Component
{
    use WithFileUploads;

    public $companies;
    public $registerformloading;

    public $name;
    public $email;
    public $company;
    public $card;
    public $password;
    public $confirmpassword;

    public $issueDate;
    public $expiryDate;

    public $dob;
    public $sex;

    public $image;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email|unique:users,email',
        'company' => 'required',
        'card' => 'required',
        'password' => 'required|min:6',
        'confirmpassword' => 'required|min:6',
        'issueDate' => 'required',
        'expiryDate' => 'required',
        'sex' => 'required',
        'dob' => 'required',
        'image' => 'required'
    ];

    public function submit(){

        $this->validate();

        DB::beginTransaction();

        try{
            $user = new User;
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->save();

            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->sex = $this->sex;
            $customer->dob = $this->dob;
            $customer->save();

            $card = new InsuranceCard;
            $card->owner_id = $user->id;
            $card->company_id = $this->company;
            $card->type = 'Health';
            $card->insurance_number = $this->card;
            $card->issue_date = $this->issueDate;
            $card->expiry_date = $this->expiryDate;
            $card->image = $this->image->store('cards');
            $card->save();

            // Mail::to($user)->send(new RegistrationConfirm());

            DB::commit();

            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                return redirect('/dashboard/customer/home');
            }

        } catch (\Exception $e){
            DB::rollback();
            dd($e);
            // return \redirect()->back();
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
