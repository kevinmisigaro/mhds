<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customer(){
        return $this->hasOne(Customer::class);
    }

    public function cards(){
        return $this->hasMany(InsuranceCard::class,'owner_id');
    }

    public function complaint(){
        return $this->hasMany(Complaint::class);
    }

    public function prescription(){
        return $this->hasMany(Prescription::class);
    }

    public function managerPrescriptionApproved(){
        return $this->hasMany(Prescription::class);
    }

    public function insurerPrescriptionApproved(){
        return $this->hasMany(Prescription::class);
    }

    public function insuranceCompanyManaged(){
        return $this->hasOne(InsuranceCompany::class,'manager_id','id');
    }
}
