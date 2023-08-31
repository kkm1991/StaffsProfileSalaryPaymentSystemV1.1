<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\StaffProfile;
use App\Models\EducationList;
use App\Models\PositionList;
use App\Models\WorkingDepList;
 

class reservationController extends Controller
{
     
    public function show($id){
           
        $currentMonth = date('m');
        $currentYear = date('Y');
        $checkreservation=reservation::where('staff_id',$id)->whereMonth('created_at',$currentMonth)->whereYear('created_at',$currentYear)->get();
        $staffinfo=StaffProfile::find($id);
        if($checkreservation->count()>0){
            return view('Reservation.showreservation',['showreservation'=>$checkreservation],['staffid'=>$staffinfo]);
        }
        else{
            return view('Reservation.newreservation',['staffid'=>$staffinfo]);
        }
       
         
    }
    public function create(){
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
        $addreservation->advance_salary=request()->advanceSalary;
        $addreservation->staff_id=request()->staffid ;
         
        $addreservation->save();
        return redirect('/paymentlist'); //return view ဆိုရင် view folder ထဲကပတ်လမ်းကိုပေးရတာ redirect ဆိုရင် route ထဲကလမ်းကြောင်းပေးရတာ
    }
    public function update(){
        
        $updatereservation=reservation::find(request()->reservation_id);
        $updatereservation->rareCost=request()->rareCost;
        $updatereservation->bonus=request()->bonus;
        $updatereservation->attendedBonus=request()->attendedBonus;
        $updatereservation->busFee=request()->busFee;
        $updatereservation->mealDeduct=request()->mealDeduct;
        $updatereservation->absence=request()->absence;
        $updatereservation->ssbFee=request()->ssbFee;
        $updatereservation->fine=request()->fine;
        $updatereservation->redeem=request()->redeem;
        $updatereservation->otherDeductLable=request()->otherDeductLable;
        $updatereservation->otherDeduct=request()->otherDeduct;
        $updatereservation->advance_salary=request()->advanceSalary;
        $updatereservation->save();
        return redirect('/paymentlist'); //return view ဆိုရင် view folder ထဲကပတ်လမ်းကိုပေးရတာ redirect ဆိုရင် route ထဲကလမ်းကြောင်းပေးရတာ
        
    }

     
    public function defaultreservationpage(){
           
        $currentMonth = date('m');
        $currentYear = date('Y');
        
        $currentMonthReservation= reservation::whereMonth('created_at',$currentMonth)->whereYear('created_at',$currentYear)->get();

            return view('Reservation.defaultreservation',['reservation'=>$currentMonthReservation]);
    }

    public function defaultreservationUpdate($reservationid){
         
        
            $updatereservation=reservation::find($reservationid);
            $updatereservation->rareCost=request()->rareCost;
            $updatereservation->bonus=request()->bonus;
            $updatereservation->attendedBonus=request()->attendedBonus;
            $updatereservation->busFee=request()->busFee;
            $updatereservation->mealDeduct=request()->mealDeduct;
            $updatereservation->absence=request()->absence;
            $updatereservation->ssbFee=request()->ssbFee;
            $updatereservation->fine=request()->fine;
            $updatereservation->redeem=request()->redeem;
            $updatereservation->otherDeductLable=request()->otherDeductLable;
            $updatereservation->otherDeduct=request()->otherDeduct;
            $updatereservation->advance_salary=request()->advanceSalary;
            $updatereservation->save();
            return redirect('/default'); //return view ဆိုရင် view folder ထဲကပတ်လမ်းကိုပေးရတာ redirect ဆိုရင် route ထဲကလမ်းကြောင်းပေးရတာ
            
        
    }
}
