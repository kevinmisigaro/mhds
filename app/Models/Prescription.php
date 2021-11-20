<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    public $fillable = [
        'approved_by_admin', 'approved_by_insurer', 'patient_id', 'image', 'card_id',
        'delivery_date', 'hospital_name', 'company_id','insurance_comment'
    ];

    public function details(){
        return $this->hasMany(PrescriptionDetails::class);
    }

    public function patient(){
        return $this->belongsTo(User::class,'patient_id','id');
    }

    public function card(){
        return $this->belongsTo(InsuranceCard::class,'card_id','id');
    }

    public function company(){
        
    }

    public function deliveries(){
        return $this->hasMany(Delivery::class);
    }

    public function managerApproved(){
        return $this->belongsTo(User::class,'manager_id','id');
    }

    public function insurerApproved(){
        return $this->belongsTo(User::class,'insurer_id','id');
    }
}
