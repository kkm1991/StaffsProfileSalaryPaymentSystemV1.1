<?php

namespace App\Http\Controllers;

use App\Models\EducationList;
use App\Models\PositionList;
use App\Models\Salary;
use App\Models\StaffProfile;
use App\Models\WorkingDepList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class StaffProfileController extends Controller
{
   public function __construct()
{
 $this->middleware('auth')->except(['index', 'staffcard','showstatuslist']);
}

   public function index(){

    $searchbydep=WorkingDepList::all(['*']);
    if(request()->searchby=="")
    {
      $table=StaffProfile::latest()->get();
    }
    else{
      $table=StaffProfile::where('WORK_DEP',request()->searchby)->latest()->get();
    }
    return view('StaffProfiles.index',['profiles'=>$table],['deps'=>$searchbydep]);
   }

   public function showstatuslist(){

      $currentMonth = date('m');
        $currentYear = date('Y');

      $searchbydep=WorkingDepList::all(['*']);
      //ယခုလတွက်လစာပေးပြီးသား သူတွေရဲ့ id တွေကိုပဲဆွဲထုတ်လိုက်ပြီး $staffIds ထဲထဲ့လိုက်တယ်
      $staffIds = Salary::whereMonth('created_at', $currentMonth)
      ->whereYear('created_at', $currentYear)
      ->pluck('staff_id') //id တစ်column ပဲဆွဲထုတ်တာ
      ->toArray();
// ပြီးတော့မှ  StaffProfile ထဲမှာ အဲ့ဒီ $staffIds ထဲမှာမပါတဲ့သူတွေကိုပဲဆွဲထုတ်ပြီး ပြစေချင်လို. အချုပ်က ယခုလ CURRENT မှာလစာပေးပြီးသားသူတွေကိုမပေါ်စေချင်လို.
      if (request()->searchby == "") {

         $table = StaffProfile::where('STATUS', 1)
            ->whereNotIn('id', $staffIds)
            ->get();
      } else {
         $table = StaffProfile::where('STATUS', 1)
            ->where('WORK_DEP', request()->searchby) // ဌာန အလိုက်ရှာလို ဒီတစ်ကြောင်းတိုးသွားတာ
            ->whereNotIn('id',$staffIds)
            ->get();
      }


      return view('StaffProfiles.paymentlist',['profiles'=>$table],['deps'=>$searchbydep] );
   }
   public function deductionadding(){
      return view('StaffProfiles.deduction_adding');
   }

   public function add(){
      $education=EducationList::all(['*']);
      $deps=WorkingDepList::all(['*']);
      $positions=PositionList::all(['*']);

      return view('StaffProfiles.add',['education'=>$education,'deps'=>$deps,'pos'=>$positions] );
   }


   // profile စာမျက်နှာက staff တစ်ဦးချင်းဆီရဲ့ status ကို update လုပ်တာ
   public function statuschange($id){
      $status=StaffProfile::find($id);
      if($status->STATUS==0){
         $status->STATUS=1;
      }
      elseif($status->STATUS==1){
         $status->STATUS=0;
      }
       $status->save();
       return redirect('/');
   }

   public function create(){
      $validator=validator((request()->all()),[
         'staffname'=>'required',
         'working_dep_list'=>'required',
         'position_list'=>'required',
         'basic_salary'=>'required',
      ]);
      if($validator->fails()){
         return back()->withErrors($validator);
      }

      $creatprofile=new StaffProfile;
      $creatprofile->Name=request()->staffname;
      $creatprofile->Father_Name=request()->fathername;
      $creatprofile->NRC=request()->nrc;
      $creatprofile->DOB=request()->datepicker;
      $creatprofile->EDUCATION=request()->edcuation_list;
      $creatprofile->WORK_DEP=request()->working_dep_list;
      $creatprofile->WORK_POSITION=request()->position_list;
      $creatprofile->BASIC_SALARY=request()->basic_salary;
      $creatprofile->START_WORKING_DATE=request()->startworkingdate;
      $creatprofile->DEBT=0;
      $creatprofile->ADDRESS=request()->address;
      if (request()->hasFile('photo')) {
         $photo = request()->file('photo');

         if ($photo->isValid()) {
             $name = $photo->getClientOriginalName();
             $photo->storeAs('staffimages', $name, 'public');
         }
     }

      $creatprofile->PHOTO_NAME=request()->file('photo')->getClientOriginalName();
      $creatprofile->STATUS=1;
      $creatprofile->save();
      return redirect('/');
   }
   public function toeditprofile(){

   }
   // update မလုပ်ခင် ရွေးလိုက်တဲ့ profile ရဲ့ data ကိုလာပြရန်
   public function editprofile($id){
      $toeditdata=StaffProfile::find($id);
      $education=EducationList::all(['*']);
      $deps=WorkingDepList::all(['*']);
      $positions=PositionList::all(['*']);
      return view('StaffProfiles.edit',['profiledata'=>$toeditdata,'education'=>$education,'deps'=>$deps,'pos'=>$positions]);

   }
   public function updateprofile($id){
      $toupdate=StaffProfile::find($id);
      $toupdate->Name=request()->staffname;
      $toupdate->Father_Name=request()->fathername;
      $toupdate->NRC=request()->nrc;
      $toupdate->DOB=request()->datepicker;
      $toupdate->EDUCATION=request()->edcuation_list;
      $toupdate->WORK_DEP=request()->working_dep_list;
      $toupdate->WORK_POSITION=request()->position_list;
      $toupdate->BASIC_SALARY=request()->basic_salary;
      $toupdate->START_WORKING_DATE=request()->startworkingdate;
      $toupdate->ADDRESS=request()->address;
      if (request()->hasFile('photo')) {
         $photo = request()->file('photo');

         if ($photo->isValid()) {
            //အရင်ပုံအဟောင်းကိုဖျက်တာ
             $oldphoto=$toupdate->PHOTO_NAME;
             Storage::disk('public')->delete('staffimages/' . $oldphoto);
            //နောက်ပုံအသစ်name ကို database ထဲမှာသိမ်းတယ် ဓာတ်ပုံကို project folder ထဲသိမ်းတယ်
             $name = $photo->getClientOriginalName();
             $photo->storeAs('staffimages', $name, 'public');// public ထဲက  storage ထဲက staffimages ထဲမှာသိမ်းတယ်  (php artisan storage:link)
             $toupdate->PHOTO_NAME=request()->file('photo')->getClientOriginalName();
         }
     }
     $toupdate->save();
     return redirect('/');
   }
   public function deleteprofile($id){
      $deletep=StaffProfile::find($id);
      $todeleteimg=$deletep->PHOTO_NAME;
      $deletep->delete();
      Storage::disk('public')->delete('staffimages/'.$todeleteimg);
      return redirect('/')->with('success','Profile successfully deleted');
   }
   public function staffcard($id){
      $forstaffcard=StaffProfile::find($id);
      return view('StaffProfiles.staffcard',['forstaffcard'=>$forstaffcard]);
   }

   public function detail($id){
    $profileDetail=StaffProfile::find($id);

    return view('StaffProfiles.profileDetail',['profileDetail'=>$profileDetail]);
   }
}
