<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\StockBatch;
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
            'dosage' => $request->dosage,
            'strength' => $request->strength,
        ]);

        return \redirect()->back();
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'generic' => 'required|unique:stocks,generic_name',
            'brand' => 'required|unique:stocks,brand_name',
            'dose' => 'required',
            'strength' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('message', 'The drug name you entered exists');

            return \redirect()->back();
        }

        $stock = new Stock;
        $stock->generic_name = Str::ucfirst($request->generic);
        $stock->brand_name = Str::ucfirst($request->brand);
        $stock->strength = $request->strength;
        $stock->dosage = $request->dose;

        if($stock->save()){
            session()->flash('message', 'Stock added.');  

            return redirect('/dashboard/admin/stock');
        }

        session()->flash('message', 'The drug name you entered exists');

        return \redirect()->back();
    }

    public function stockList($id){
        $checkIfStockExists = StockBatch::where('stock_id', $id)->exists();

        $stock_id = $id;

        if($checkIfStockExists){
            $stock = StockBatch::where('stock_id', $id)->orderBy('created_at', 'desc')->get();
            return view('dashboard.admin.stock-list', \compact('stock','stock_id'));
        }
        $stock = [];
        return view('dashboard.admin.stock-list', \compact('stock', 'stock_id'));
    }

    public function storeStockList(Request $request){
        $validator = Validator::make($request->all(), [
            'batch' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'expiryDate' => 'required'
        ]);

        if ($validator->fails()) {
            //
        }

        if(!StockBatch::where('quantity', '>', 0)->exists()){

            StockBatch::create([
                'batch_number' => $request->batch,
                'stock_id' => (int)$request->id,
                'quantity' => (float)$request->quantity,
                'expiry_date' => $request->expiryDate,
                'purchase_price' => $request->price
            ]);
    
            session()->flash('message', 'Stock list added.');
    
            return \redirect('dashboard/admin/stock');
        }

            session()->flash('message', 'Cannot add to stock list, item still in stock.');
    
            return \redirect('dashboard/admin/stock');
    }

    public function status($id){
        $stock = Stock::where('id',$id)->first();

        $stock->update([
            'status' => !$stock->status
        ]);

        return redirect()->back();
    }
}
