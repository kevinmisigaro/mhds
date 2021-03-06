<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDetails extends Model
{
    use HasFactory;

    protected $table = 'prescription_details';

    protected $fillable = ['quantity','selling_price'];

    protected $appends = ['total_price'];

    public function getTotalPriceAttribute(){
        return $this->quantity * $this->selling_price;
    }

    public function prescription(){
        return $this->belongsTo(Prescription::class,'prescription_id','id');
    }

    public function drug(){
        return $this->belongsTo(Stock::class,'drug_id','id');
    }
}
