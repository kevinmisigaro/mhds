<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDetails extends Model
{
    use HasFactory;

    protected $table = 'prescription_details';

    public function prescription(){
        return $this->belongsTo(Prescription::class,'prescription_id','id');
    }
}
