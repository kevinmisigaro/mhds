<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StockController extends Controller
{
    public function index(){
        $stock = Stock::all();
        return view('dashboard.admin.stock',\compact('stock'));
    }

    public function create(){
        return \view('dashboard.admin.new-stock');
    }

    public function update(Request $request){
        $stock = Stock::where('id', $request->id)->first();

        $stock->update([
            'generic_name' => $request->generic,
            'brand_name' => $request->brand,
            'quantity' => $request->quantity,
            'purchase_price' => $request->price,
            'dosage' => $request->dosage,
            'strength' => $request->strength,
            'expiry_date' => $request->date
        ]);

        return \redirect()->back();
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'generic' => 'required|unique:stocks,generic_name',
            'brand' => 'required|unique:stocks,brand_name',
            'dose' => 'required',
            'strength' => 'required',
            'date' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            session()->flash('message', 'The drug name you entered exists');

            return \redirect()->back();
        }

        $stock = new Stock;
        $stock->generic_name = Str::ucfirst($request->generic);
        $stock->brand_name = Str::ucfirst($request->brand);
        $stock->expiry_date = $request->date;
        $stock->strength = $request->strength;
        $stock->quantity = $request->quantity;
        $stock->dosage = $request->dose;
        $stock->purchase_price = $request->price;

        if($stock->save()){
            session()->flash('message', 'Stock added.');  

            return redirect('/dashboard/admin/stock');
        }

        session()->flash('message', 'The drug name you entered exists');

        return \redirect()->back();

    }
}
