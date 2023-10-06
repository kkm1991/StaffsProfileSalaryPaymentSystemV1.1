<?php

namespace App\Http\Controllers;

use App\Models\DefaultReservation;
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
        $defaultReservation=DefaultReservation::where('staff_id',$id)->get();

        if($checkreservation->count()>0){
            return view('Reservation.showreservation',['showreservation'=>$checkreservation],['staffid'=>$staffinfo]);
        }
        else{

            return view('Reservation.newreservation',['defaultreservation'=>$defaultReservation,'staffid'=>$staffinfo]);
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

        $updatereservation=reservation::find(request()->s);
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

    public function delete($id){
        reservation::find($id)->delete();
        return redirect('/default');
    }
    public function defaultreservationpage(){

        $selectedMonth = request()->input('monthPicker');
        if($selectedMonth){

            $timestamp = strtotime($selectedMonth);
            $startDateTime = date('Y-m-01 00:00:00', $timestamp);
            $endDateTime = date('Y-m-t 23:59:59', $timestamp);

            $currentMonthReservation= reservation::whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            $result=false;
            return view('Reservation.defaultreservation',['reservation'=>$currentMonthReservation,'default'=>$result]) ;

        }
        else{
            $currentMonthReservation= DefaultReservation::all();
            $result=true;
                return view('Reservation.defaultreservation',['reservation'=>$currentMonthReservation,'default'=>$result]) ;

        }

    }

    public function defaultreservationUpdate($reservationid){

        $default=request()->DEFAULT;
        if($default=='DEFAULT'){
            $updatereservation=DefaultReservation::find($reservationid);
        }
        else
        {
            $updatereservation=reservation::find($reservationid);
        }


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
  public function addnewdefaultreservation(){
    $table=StaffProfile::where('STATUS', 1)
    ->get();

    return view('Reservation.newdefaultreservation',['staffs'=>$table]);
  }
  public function createnewdefaultreservation(){

        $checkdefaultreservation=DefaultReservation::where('staff_id', request()->staff_id)->get();
    if($checkdefaultreservation->count()>0){
        return redirect('/default')->with('alreadyexit',"ပုံသေ ကြိုတင်စာရင်းထဲ့တွင်ရှိပြီးသားဖြစ်ပါသည်");
    }
    else{
        $addreservation=new DefaultReservation;
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
        $addreservation->staff_id=request()->staff_id ;

        $addreservation->save();
        return redirect('/default')->with('success',"ပုံသေ ကြိုတင်စာရင်းဝင်ရောက်သွားပါပြီ");
    }

  }

}
