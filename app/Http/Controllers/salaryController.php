<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\reservation;
use Illuminate\Support\Carbon;
class salaryController extends Controller
{
    public function addsalary($id,Request $request){
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $checkreservation=reservation::where('staff_id',$id)->whereMonth('created_at',$currentMonth)->whereYear('created_at',$currentYear)->get();

        if($checkreservation->count()>0){
            $checksalary=Salary::where('staff_id',$id)->whereMonth('created_at',$currentMonth)->whereYear('created_at',$currentYear)->get();
            if($checksalary->count()>0){
                return redirect('/paymentlist')->with('warning','ယခုဝန်ထမ်းသည်လစာပေးပြီးသားဖြစ်ပါသည်');
            }
            else{
                $basicsalary=$request->query('basic_salary');
                $paysalary=new Salary;
                $paysalary->basicSalary=$request->query('basic_salary');
                    foreach($checkreservation as $reservation){
                        $rarecost=$reservation->rareCost;
                        $bonus=$reservation->bonus;
                        $attendedBonus=$reservation->attendedBonus;
                        $busFee=$reservation->busFee;
                        $First_Total=$basicsalary+($rarecost+$bonus+$attendedBonus+$busFee);
    
                        $paysalary->rareCost=$rarecost;
                        $paysalary->bonus=$bonus;
                        $paysalary->attendedBonus=$attendedBonus;
                        $paysalary->busFee=$busFee;
                        $paysalary->First_Total=  $First_Total;
    
                        $mealDeduct=$reservation->mealDeduct;
                        $absence=$reservation->absence;
                        $ssbFee=$reservation->ssbFee;
                        $fine=$reservation->fine;
                        $redeem=$reservation->redeem;
                        $otherDeductLable=$reservation->otherDeductLable;
                        $otherDeduct=$reservation->otherDeduct;
                        $staff_id=$reservation->staff_id;
                        $Final_Total=$First_Total-($mealDeduct+$absence+$ssbFee+ $fine+$redeem+$otherDeduct);
    
                        $paysalary->mealDeduct=$mealDeduct;
                        $paysalary->absence=$absence;
                        $paysalary->ssbFee=$ssbFee;
                        $paysalary->fine=$fine;
                        $paysalary->redeem=$redeem;
                        $paysalary->otherDeductLable=$otherDeductLable;
                        $paysalary->otherDeduct=$otherDeduct;
                        $paysalary->staff_id=$staff_id;
                        $paysalary->Final_Total= $Final_Total;
                        $paysalary->save();
                        return redirect('/paymentlist');
    
                    
                     }
            
                }
        }
        else{
            return redirect('/paymentlist')->with('warning','ယခုဝန်ထမ်းအတွက် ကြိုတင်စာရင်းမထဲ့ရသေးပါ');
        }
        

    }
    public function showsalary(){
        
    }
}
