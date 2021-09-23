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
            //on failed
        }

        $margin = ProfitMargin::where('company_id', $request->companyId)->first();
        $margin->margin = (float)$request->price;
        $margin->save();

        session()->flash('message', 'Selling price for '. $margin->company->company_name .' updated');

        return \redirect()->back();
    }
}
