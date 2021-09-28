<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrescriptionDetails;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    public function storePrescription(Request $request){

        $validator = Validator::make($request->all(), [
            'drug' => 'required',
            'price' => 'required',
            'id' => 'required',
            'quantity' => 'required'
        ]);

        $p = new PrescriptionDetails;
        $p->prescription_id = $request->id;
        $p->drug_id = $request->drug;
        $p->selling_price = $request->price;
        $p->quantity = $request->quantity;
        $p->save();

        return \redirect('/dashboard/insurer/prescription/'. $request->id);
    }
}
