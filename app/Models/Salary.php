<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    public function profiles(){
        return $this->belongsTo('App\Models\StaffProfile','staff_id');
    }
    public function deps(){
        return $this->belongsTo('App\Models\WorkingDepList','dep');
    }
    
}
