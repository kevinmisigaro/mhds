<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\InsuranceCompany;
use App\Models\ProfitMargin;

class CompanyController extends Controller
{
    public function updateSellingPrice(Request $request){

        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'companyId' => 'required'
        ]);

        if ($validator->fails()) {
            return \redirect()->back();
        }

        $company = InsuranceCompany::where('id', $request->companyId)->update([
            'margin' => (float)$request->price
        ]);

        session()->flash('message', 'Selling price updated');

        return \redirect()->back();
    }

    public function updateStatus($id){
        $company = InsuranceCompany::where('id', $id)->first();

        $company->update([
            'active' => !$company->active
        ]);

        return \redirect()->back();
    }
}
