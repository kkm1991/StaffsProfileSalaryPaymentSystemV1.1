<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'rareCost',
        'bonus',
        'attendedBonus',
        'busFee',
        'First_Total',
        'mealDeduct',
        'absence',
        'ssbFee',
        'fine',
        'redeem',
        'otherDeductLable',
        'otherDeduct',
        'Final_Total',
        'created_at'
        // Add other fields here as needed
    ];
    use HasFactory;
    public function profiles(){
        return $this->belongsTo('App\Models\StaffProfile','staff_id');
    }
    public function deps(){
        return $this->belongsTo('App\Models\WorkingDepList','dep');
    }

}
