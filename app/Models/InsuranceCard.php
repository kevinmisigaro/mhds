<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCard extends Model
{
    use HasFactory;

    protected $table = 'insurance_cards';

    public function owner(){
        return $this->belongsTo(User::class,'owner_id','id');
    }

    public function company(){
        return $this->belongsTo(InsuranceCompany::class,'company_id','id');
    }
}
