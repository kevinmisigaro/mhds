<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_number', 'stock_id', 'quantity',
         'purchase_price', 'expiry_date', 'in_stock', 'out_of_stock_counter'
    ];

    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id','id');
    }
}
