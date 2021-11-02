<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id', 'total_amount', 'approved_amount', 'dispatched_by_sp',
        'invoice_generated', 'customer_delivery_accept', 'insurer_process_payment',
        'sp_confirm_payment'
    ];

    public function prescription(){
        return $this->belongsTo(Prescription::class);
    }
}
