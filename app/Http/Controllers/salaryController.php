<?php

namespace App\Http\Controllers;

use App\Models\WorkingDepList;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\reservation;
use App\Models\StaffProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class salaryController extends Controller
{
    public function addsalary($id, Request $request)
    {
        // $currentMonth = (new \DateTime())->format('m');
        // $currentYear = (new \DateTime())->format('y');
         
        $currentMonth = date('m');
        $currentYear = date('Y');
        $checkreservation = reservation::where('staff_id', $id)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->get();

        if ($checkreservation->count() > 0) {
            $checksalary = Salary::where('staff_id', $id)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->get();
            if ($checksalary->count() > 0) {
                return redirect('/paymentlist')->with('alreadypay', 'ယခုဝန်ထမ်းသည်လစာပေးပြီးသားဖြစ်ပါသည်');
            } else {
                $basicsalary = $request->query('basic_salary');
                $paysalary = new Salary;
                $paysalary->basicSalary = $request->query('basic_salary');
                foreach ($checkreservation as $reservation) {
                    $rarecost = $reservation->rareCost;
                    $bonus = $reservation->bonus;
                    $attendedBonus = $reservation->attendedBonus;
                    $busFee = $reservation->busFee;
                    $First_Total = $basicsalary + ($rarecost + $bonus + $attendedBonus + $busFee);

                    $paysalary->rareCost = $rarecost;
                    $paysalary->bonus = $bonus;
                    $paysalary->attendedBonus = $attendedBonus;
                    $paysalary->busFee = $busFee;
                    $paysalary->First_Total = $First_Total;


                    $advancesalary=$reservation->advance_salary;
                    $mealDeduct = $reservation->mealDeduct;
                    $absence = $reservation->absence;
                    $ssbFee = $reservation->ssbFee;
                    $fine = $reservation->fine;
                    $redeem = $reservation->redeem;
                    $otherDeductLable = $reservation->otherDeductLable;
                    $otherDeduct = $reservation->otherDeduct;
                    $staff_id = $reservation->staff_id;
                    $Final_Total = $First_Total - ($mealDeduct + $absence + $ssbFee + $fine + $redeem + $otherDeduct +$advancesalary);

                    $paysalary->advance_salary=$advancesalary;
                    $paysalary->mealDeduct = $mealDeduct;
                    $paysalary->absence = $absence;
                    $paysalary->ssbFee = $ssbFee;
                    $paysalary->fine = $fine;

                    $paysalary->redeem = $redeem;


                    //ဝန်ထမ်းကြွေးဆပ် ကို အကြွေးစာရင်းထဲကသွားနူတ်   
                    $redeemDept = StaffProfile::find($staff_id);
                    $redeemDept->DEBT = ($redeemDept->DEBT - $redeem);
                    $redeemDept->save();

                    $paysalary->otherDeductLable = $otherDeductLable;
                    $paysalary->otherDeduct = $otherDeduct;
                    $paysalary->staff_id = $staff_id;
                    $paysalary->dep = $request->query('work_dep');
                    $paysalary->Final_Total = $Final_Total;
                    $paysalary->save();
                    $message = "ဝန်ထမ်း  " . $reservation->staffprofile->Name . " သည်လစာပေးစာရင်းထဲ့ဝင်သွားပါပြီ";
                    return redirect('/paymentlist')->with('success', $message);


                }

            }
        } else {
            return redirect('/paymentlist')->with('warning', 'ယခုဝန်ထမ်းအတွက် ကြိုတင်စာရင်းမထဲ့ရသေးပါ');
        }


    }
    public function showsalary()
    {
        // $currentMonth = (new \DateTime())->format('m');
        // $currentYear = (new \DateTime())->format('y');
          
        $currentMonth = date('m');
        $currentYear = date('Y');

        $selecteddep = request()->searchby;
        $showdep=WorkingDepList::find($selecteddep);
        $selectedMonth = request()->input('monthPicker');
        $serachbydep = WorkingDepList::all(['*']);
        $action = request()->input('action');

         

        $salaries = Salary::query();
        if ($action === 'search') {

            if ($selecteddep && $selectedMonth) {

                $startDateTime = Carbon::createFromFormat('Y-m-d', $selectedMonth . '-01')->startOfMonth();
                $endDateTime = Carbon::createFromFormat('Y-m-d', $selectedMonth . '-01')->endOfMonth();
                $salaries->where('dep', $selecteddep)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderByDesc('basicSalary');
            } elseif ($selecteddep) {
                return redirect('/salaries')->with('warning', "ဌာန နှင့် လ/နှစ် စုံအောင်ရွေးပေးပါ");
            } elseif ($selectedMonth) {
                return redirect('/salaries')->with('warning', "ဌာန နှင့် လ/နှစ် စုံအောင်ရွေးပေးပါ");
            } else {
                $salaries->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->orderByDesc('basicSalary');
            }


            $salaries = $salaries->get('*');
            return view('Salaries.salary', ['salaries' => $salaries,'deps' => $showdep ,'depforoption'=>$serachbydep,])->with('showtotal',$showdep) ;
        } 

        elseif ($action === 'print') {
            if ($selecteddep && $selectedMonth) {

                $startDateTime = Carbon::createFromFormat('Y-m-d', $selectedMonth . '-01')->startOfMonth();
                $endDateTime = Carbon::createFromFormat('Y-m-d', $selectedMonth . '-01')->endOfMonth();
                $salaries->where('dep', $selecteddep)->whereBetween('created_at', [$startDateTime, $endDateTime])->orderByDesc('basicSalary');
            } elseif ($selecteddep) {
                return redirect('/salaries')->with('warning', "ဌာန နှင့် လ/နှစ် စုံအောင်ရွေးပေးပါ");
            } elseif ($selectedMonth) {
                return redirect('/salaries')->with('warning', "ဌာန နှင့် လ/နှစ် စုံအောင်ရွေးပေးပါ");
            } else {
                $salaries->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->orderByDesc('basicSalary');
            }


            $salaries = $salaries->get(['*']);


            return view('Salaries.salariesreport', ['salaries' => $salaries,'deps' => $showdep,'datemonth'=> $selectedMonth]);

        } else {
                $salaries->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear);
            $salaries = $salaries->get(['*']);
            return view('Salaries.salary', ['salaries' => $salaries,'depforoption'=>$serachbydep,'deps' => "ဌာနအားလုံး"]);
        }




    }
    public function deletesalary($id, Request $request)
    {
        $currentMonth = (new \DateTime())->format('m');
        $currentYear = (new \DateTime())->format('y');
        $salarydelete = Salary::find($id);
        $salarydelete->delete();

        $redeemDept = StaffProfile::find($salarydelete->staff_id);
        $redeemDept->DEBT = ($redeemDept->DEBT + $salarydelete->redeem);
        $redeemDept->update();
        $deletedmessage = $request->query('profileName');
        return redirect('/salaries')->with('deleted', "ဝန်ထမ်း $deletedmessage ကို ($currentMonth/$currentYear) လစာပေးစာရင်းမှဖျက်ပြီးပါပြီ");
    }
    public function report(Request $request)
    {

        $selecteddate = $request->query('monthPicker'); // Assuming this is where you're getting the selected date

        // Convert the selected date to a format that Carbon can understand
        $timestamp = strtotime($selecteddate);
        
         
       
        if($selecteddate){
            $startDateTime = date('Y-m-01 00:00:00', $timestamp);
            $endDateTime = date('Y-m-t 23:59:59', $timestamp);
            $summary = WorkingDepList::select('working_dep_lists.id as dep_id', 'dep_name', 
            DB::raw('COUNT(DISTINCT salaries.staff_id) as staff_count'),
            DB::raw('SUM(salaries.Final_Total) as total_salary')
        )
        ->leftJoin('salaries', 'working_dep_lists.id', '=', 'salaries.dep')
        ->whereBetween('salaries.created_at', [$startDateTime,$endDateTime])
         
        ->groupBy('working_dep_lists.id', 'dep_name')
        ->get();
        
    } else {
        // Handle the case when no date is selected
        $summary = []; // Empty array or null as needed
    }
    return view('Salaries.report',['report'=>$summary]);
    }

    
     
    public function salaryandreservationedit($salaryid){
       
        $validator=validator((request()->all()),[
            'rarecost'=>'required|numeric',
            'bonus'=>'required|numeric',
            'attendedbonus'=>'required|numeric',
            'busfee'=>'required|numeric',
            'mealdeduct'=>'required|numeric',
            'absence'=>'required|numeric',
            'ssbfee'=>'required|numeric',
            'fine'=>'required|numeric',
            'redeem'=>'required|numeric',
            'other'=>'required|numeric', 
         ]);
         if($validator->fails()){
            return back()->withErrors($validator);
         }

        $updatesalary=Salary::find($salaryid);
         $updatesalary->update([
            'rareCost'=>request()->rarecost,
            'bonus'=>request()->bonus,
            'attendedBonus'=>request()->attendedbonus,
            'busFee'=>request()->busfee,
            'First_Total'=>request()->firsttotal,

            'advance_salary'=>request()->advancesalary,
            'mealDeduct'=>request()->mealdeduct,
            'absence'=>request()->absence,
            'ssbFee'=>request()->ssbfee,
            'fine'=>request()->fine,
            'redeem'=>request()->redeem,
            'otherDeductLable'=>request()->otherlabel,
            'otherDeduct'=>request()->other,
            'Final_Total'=>request()->finaltotal,
         ]);
         $staffid=request()->input('staffid');
         $created=$updatesalary->created_at;
        
    $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $created)->startOfMonth();
    $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $created)->endOfMonth();
       $this->updatereservationFromSalary($staffid,$startDateTime,$endDateTime);
       
          
         return redirect('/salaries');
    }
    public function updatereservationFromSalary($staffid,$startDateTime,$endDateTime){
        $updatereservation=reservation::find($staffid)->whereBetween('created_at', [$startDateTime, $endDateTime]);
        //  $updatereservation->rareCost =request()->rarecost;
        //  $updatereservation->bonus =request()->bonus;
        //  $updatereservation->attendedBonus =request()->attendedbonus;
        //  $updatereservation->busFee =request()->busfee;
        //  $updatereservation->advance_salary =request()->advancesalary;
        //  $updatereservation->mealDeduct =request()->mealdeduct;
        //  $updatereservation->absence =request()->absence;
        //  $updatereservation->ssbFee =request()->ssbfee;
        //  $updatereservation->fine =request()->fine;
        //  $updatereservation->redeem =request()->redeem;
        //  $updatereservation->otherDeductLable =request()->otherlabel;
        //  $updatereservation->otherDeduct =request()->other;
          
        //  $updatereservation->update();


         $updatereservation->update([
            'rareCost'=>request()->rarecost,
            'bonus'=>request()->bonus,
            'attendedBonus'=>request()->attendedbonus,
            'busFee'=>request()->busfee,

            'advance_salary'=>request()->advancesalary,
            'mealDeduct'=>request()->mealdeduct,
            'absence'=>request()->absence,
            'ssbFee'=>request()->ssbfee,
            'fine'=>request()->fine,
            'redeem'=>request()->redeem,
            'otherDeductLable'=>request()->otherlabel,
            'otherDeduct'=>request()->other,
         ]);
    }
}