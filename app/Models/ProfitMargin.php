<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitMargin extends Model
{
    use HasFactory;

    protected $table = 'profit_margins';

    public function company(){
        return $this->belongsTo(InsuranceCompany::class,'company_id','id');
    }
}
