<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    protected $fillable =['created_at','bonus','attendedBonus','busFee', 'advance_salary', 'mealDeduct','absence','ssbFee', 'fine', 'redeem','otherDeductLable','otherDeduct'];
    use HasFactory;

    public function staffprofile(){
        return $this->belongsTo('App\Models\StaffProfile','staff_id');
    }


}
