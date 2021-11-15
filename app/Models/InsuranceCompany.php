<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    use HasFactory;

    protected $table = "insurance_companies";

    public $fillable = ['active', 'company_name', 'manager_id'];

    public function cards(){
        return $this->hasMany(InsuranceCard::class);
    }

    public function manager(){
        return $this->belongsTo(User::class,'manager_id','id');
    }

    public function margin(){
        return $this->hasOne(ProfitMargin::class,'company_id');
    }
}
