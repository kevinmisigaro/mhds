<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public $fillable = [
        'generic_name', 'brand_name', 'quantity', 'purchase_price', 'dosage', 'strength', 'expiry_date','status'
    ];

    public function prescription(){
        return $this->hasMany(PrescriptionDetails::class);
    }
}
