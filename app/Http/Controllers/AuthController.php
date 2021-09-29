<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }

    public function company(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'company' => 'required|unique:insurance_companies,company_name',
            'pass' => 'required',
            'confirmpass' => 'required'
        ]);

        if ($validator->fails()) {
            //
        }

        DB::beginTransaction();

        try{

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->pass;
            $user->role = 'insurer';
            $user->save();

            $company = new InsuranceCompany;
            $company->company_name = $request->company;
            $company->manager_id = $user->id;
            $company->save();

            DB::commit();

            if (Auth::attempt(['email' => $user->email, 'password' => $user->password])) {
                return redirect('/dashboard/insurer/home');
            }

        } catch (\Exception $e){
            DB::rollback();
            dd($e);
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
