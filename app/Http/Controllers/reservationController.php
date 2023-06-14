<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\StaffProfile;
use App\Models\EducationList;
use App\Models\PositionList;
use App\Models\WorkingDepList;
 

class reservationController extends Controller
{
    public function add($id){
         $addreservation=new reservation;
         $addreservation->rareCost=request()->rareCost;
         $addreservation->bonus=request()->bonus;
         $addreservation->attendedBonus=request()->attendedBonus;
         $addreservation->busFee=request()->busFee;
         $addreservation->mealDeduct=request()->mealDeduct;
         $addreservation->absence=request()->absence;
         $addreservation->ssbFee=request()->ssbFee;
         $addreservation->fine=request()->fine;
         $addreservation->redeem=request()->redeem;
         $addreservation->otherDeductLable=request()->otherDeductLable;
         $addreservation->otherDeduct=request()->otherDeduct;
         $addreservation->staff_id=$id;
         $addreservation->save();
         

    }
    public function show($id){
        $currentMonth = now()->month;
        $showreservation=reservation::where('staff_id',$id)->whereMonth('created_at',$currentMonth)->get();
      
        if($showreservation->count()>0){
        return view('salarypayments.reservation',['showreserve'=>$showreservation]);
        
       }
       else{
        return view('salarypayments.addreservation');
       }
        
    }
}
