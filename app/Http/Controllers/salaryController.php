<?php

namespace App\Http\Controllers;

use App\Models\WorkingDepList;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\reservation;
use App\Models\StaffProfile;
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
                return redirect('/paymentlist')->with('warningpaysalary','ယခုဝန်ထမ်းသည်လစာပေးပြီးသားဖြစ်ပါသည်');
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
                        $paysalary->dep=$request->query('work_dep');
                        $paysalary->Final_Total= $Final_Total;
                        $paysalary->save();
                        $message="ဝန်ထမ်း  ".$reservation->staffprofile->Name." သည်လစာပေးစာရင်းထဲ့ဝင်သွားပါပြီ"  ;
                        return redirect('/paymentlist')->with('success',$message);
    
                    
                     }
            
                }
        }
        else{
            return redirect('/paymentlist')->with('warning','ယခုဝန်ထမ်းအတွက် ကြိုတင်စာရင်းမထဲ့ရသေးပါ');
        }
        

    }
    public function showsalary(){
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $selecteddep=request()->input('searchby');
        $selectedMonth=request()->input('monthPicker');
        $serachbydep=WorkingDepList::all();
         if(request()->searchby=="" ){
            if($selectedMonth){
                return back()->with('warning',"ဌာန နှင့် လ/နှစ် စုံအောင်ရွေးပေးပါ");
            }
            else{
                $salaries=Salary::whereMonth('created_at',$currentMonth)->whereYear('created_at',$currentYear)->get();
            }
           
         }
         else{
             
            
            if($selecteddep && $selectedMonth){
                $selectedYear=\Carbon\Carbon::createFromFormat('Y-m',$selectedMonth)->format('Y');
                $salaries=Salary::whereMonth('created_at',$selectedMonth)->whereYear('created_at',$selectedYear)->whereHas('deps',function ($query)use($selecteddep){
                    $query->where('dep_name',$selecteddep);
                })->get();
            }
            else{
                return back()->with('warning',"ဌာန နှင့် လ/နှစ် စုံအောင်ရွေးပေးပါ");
            }
            
         }
       // $checkreservation=reservation::where('staff_id',$id)->whereMonth('created_at',$currentMonth)->whereYear('created_at',$currentYear)->get();
       
        return view('Salaries.salary',['salaries'=>$salaries],['deps'=>$serachbydep]);
    }
    public function deletesalary($id,Request $request){
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $salarydelete=Salary::find($id);
        $salarydelete->delete();
        $deletedmessage=$request->query('profileName');
        return redirect('/salaries')->with('deleted',"ဝန်ထမ်း $deletedmessage ကို ($currentMonth/$currentYear) လစာပေးစာရင်းမှဖျက်ပြီးပါပြီ");
    }
}
