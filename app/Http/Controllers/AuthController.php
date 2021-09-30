<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsuranceCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use App\Models\InsuranceCard;

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
            $user->password = Hash::make($request->pass);
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

    public function storeCustomerByInsurer(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users, email',
            'card' => 'required',
            'type' => 'required',
            'image' => 'required|image',
            'sex' => 'required',
            'dob' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        DB::beginTransaction();

        try{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('123456');
            $user->save();

            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->sex = $request->sex;
            $customer->dob = $request->dob;
            $customer->save();

            $path = $request->file('image')->store('avatars','public');

            $card = new InsuranceCard;
            $card->insurance_number = $request->card;
            $card->owner_id = $user->id;
            $card->company_id = Auth::user()->insuranceCompanyManaged->id;
            $card->type = $request->type;
            $card->valid = true;
            $card->image = '/storage/'.$path;
            $card->save();

            DB::commit();

            return \redirect('/dashboard/insurer/customers');

        } catch (\Exception $e){
            DB::rollback();
            dd($e);
        }

    }

    public function updateCustomerImage(Request $request){
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $path = $request->file('avatar')->store('avatars','public');

        $customer = $customer = Customer::where('user_id', Auth::id())->first();

        $customer->update([
            'profile_image' => '/storage/'.$path
        ]);

        return redirect()->back();
    }

    public function updateCustomer(Request $request){

        $user = User::where('id', Auth::id())->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        $customer = Customer::where('user_id', $user->id)->first();

        $customer->update([
            'sex' => $request->sex,
            'dob' => $request->dob
        ]);

        return redirect()->back();

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
