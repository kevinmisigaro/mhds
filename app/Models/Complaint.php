<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    public function complainerDetails(){
        return $this->belongsTo(User::class,'complainer','id');
    }
}
