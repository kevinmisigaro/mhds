<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister(){

        return view('auth.register');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
