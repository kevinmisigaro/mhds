<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function submit(){
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

            return redirect('/dashboard');
        }

        session()->flash('message', 'Incorrect email or password.');
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
