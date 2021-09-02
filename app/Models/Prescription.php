<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    public function details(){
        return $this->hasMany(PrescriptionDetails::class);
    }

    public function patient(){
        return $this->belongsTo(User::class,'patient_id','id');
    }

    public function managerApproved(){
        return $this->belongsTo(User::class,'manager_id','id');
    }

    public function insurerApproved(){
        return $this->belongsTo(User::class,'insurer_id','id');
    }
}
