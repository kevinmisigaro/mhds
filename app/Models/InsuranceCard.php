<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCard extends Model
{
    use HasFactory;

    protected $table = 'insurance_cards';

    public $fillable = [
        'insurance_number', 'owner_id','company_id', 'type', 'image', 'valid', 'expiry_date', 'issue_date'
    ];

    public function owner(){
        return $this->belongsTo(User::class,'owner_id','id');
    }

    public function prescriptions(){
        return $this->hasMany(InsuranceCard::class);
    }

    public function company(){
        return $this->belongsTo(InsuranceCompany::class,'company_id','id');
    }
}
