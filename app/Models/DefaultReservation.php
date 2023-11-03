<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultReservation extends Model
{
    use HasFactory;
    public function staffprofile(){
        return $this->belongsTo('App\Models\StaffProfile','staff_id');
    }
}
