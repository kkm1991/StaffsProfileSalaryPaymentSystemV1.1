@extends('layouts/app')
@section('content')
 <!-- edit salary modal modal start -->


      <div class="container">

        <div class="">
            <form action="/salary/update/{{$salary->id}}" method="POST" >
                @csrf

                <input type="hidden" name="reservationid" id="salaryid" value="{{$salary->reservation_id}}">
                <input type="text" name="staffid" id="staffid"value="{{$salary->staff_id}}">
                <label for="" name="olddate" style="text-align: center; font-weight: bold;text-decoration: underline;">{{$salary->created_at->format('F Y')}} လစာ</label>

                <div class="row mb-2">
                    <div class="col-4">
                        <label for="">Date</label>
                    </div>
                    <div class="col-8">
                        <input class="form-control" value="{{$salary->created_at}}"  type="date" id="monthPicker" name="monthPicker" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                    </div>
                 </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">ဝန်ထမ်းအမည်</label>
                   </div>
                   <div class="col-8">
                       <input type="text" class="form-control" readonly name="name" id="name" value="{{$salary->profiles->Name}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">ဌာန</label>
                   </div>
                   <div class="col-8">
                    <input type="text" class="form-control"  readonly name="" id="" value="{{$salary->deps->dep_name}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">အခြေခံလစာ</label>
                   </div>
                   <div class="col-8">
                    <input type="text" class="form-control text-success fw-bold" readonly name="basicsalary" readonly id="basicsalary" value="{{$salary->basicSalary}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">ရှားပါးစရိတ်</label>
                   </div>
                   <div class="col-8">
                    <input type="text"class="form-control" required name="rarecost" id="rarecost" value="{{$salary->rareCost}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">ချီးမြင့်ငွေ</label>
                   </div>
                   <div class="col-8">
                    <input type="text"class="form-control" required name="bonus" id="bonus" value="{{$salary->bonus}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">ရက်မှန်ကြေး</label>
                   </div>
                   <div class="col-8">
                    <input type="text"class="form-control"  required name="attendedbonus" id="attendedbonus" value="{{$salary->attendedBonus}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">ကားခ</label>
                   </div>
                   <div class="col-8">
                    <input type="text"class="form-control" required name="busfee" id="busfee" value="{{$salary->busFee}}">
                   </div>
                </div>
                <div class="row mb-2"style="font-weight:bold">
                   <div class="col-4">
                       <label for="">လစာစုစုပေါင်း</label>
                   </div>
                   <div class="col-8" style="font-weight:bold">
                    <input type="text" class="form-control text-success fw-bold" readonly name="firsttotal" id="firsttotal" value="{{$salary->First_Total}}">
                   </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <label for="">လစာကြိုထုတ်</label>
                    </div>
                    <div class="col-8">
                     <input type="text" class="form-control"required name="advancesalary" id="advancesalary" value="{{$salary->advance_salary}}">
                    </div>
                 </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">ထမင်းဖိုး</label>
                   </div>
                   <div class="col-8">
                    <input type="text" class="form-control"required name="mealdeduct" id="mealdeduct" value="{{$salary->mealDeduct}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">အလုပ်ပျက်ရက်နူတ်</label>
                   </div>
                   <div class="col-4">
                    <label for="absence" class="form-label">အလုပ်ပျက်ရက်နူတ်</label>
                    <input type="text" id="absence" readonly name="absence" class="form-control" value="{{$salary->absence}}" >
                </div>
                <div class="col-4">
                    <label for="absence" class="form-label">အလုပ်ပျက်ရက်ထဲ့ရန်</label>
                    <input type="text" id="absenceday"  required name="absenceday" class="form-control"placeholder="အလုပ်ပျက်ရက်ထဲ့ပါ" value="0" >
                    <script>

                            var absence=document.getElementById('absence');
                            var absenceday=document.getElementById('absenceday');


                            absenceday.addEventListener('input',function(){

                              var amount=parseFloat(absenceday.value)*({{$salary->basicSalary}}/30);
                              absence.value=amount;



                      });


                    </script>
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">လူမှု့ဖူလုံရေး</label>
                   </div>
                   <div class="col-8">
                    <input type="text" class="form-control"required name="ssbfee" id="ssbfee" value="{{$salary->ssbFee}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">ဒဏ်ကြေး</label>
                   </div>
                   <div class="col-8">
                    <input type="text" class="form-control"required name="fine" id="fine" value="{{$salary->fine}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">ချေးငွေဆပ်</label>
                   </div>
                   <div class="col-8">
                    <input type="text"class="form-control"readonly required name="redeem" id="redeem" value="{{$salary->redeem}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="">အခြားနူတ်ငွေ</label>
                   </div>
                   <div class="col-8">
                    <input type="text" class="form-control"   name="otherlabel" id="otherlabel" value="{{$salary->otherDeductLable}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for=""></label>
                   </div>
                   <div class="col-8">
                    <input type="text" class="form-control" required name="other" id="other" value="{{$salary->otherDeduct}}">
                   </div>
                </div>
                <div class="row mb-2">
                   <div class="col-4">
                       <label for="" style="font-weight: bold">စုစုပေါင်းလစာ</label>
                   </div>
                   <div class="col-8"style="font-weight: bold">
                    <input type="text" class="form-control" readonly name="finaltotal" id="finaltotal" value="{{$salary->Final_Total}}">
                   </div>
                </div>
               </div>
               <button type="button" class="btn btn-secondary" onclick="cancleform()">Cancel</button>
               <button type="submit" class="btn btn-primary">Save changes</button>

            </form>


      </div>
    </div>
  </div>

  <script>

    var firsttotal=document.getElementById('firsttotal');
    var finalTotal=document.getElementById('finaltotal');
    var basicsalary=document.getElementById('basicsalary')

    // basic salary ထဲကိုအရင်ပေါင်းတာလုပ်မယ်
    var busfee=document.getElementById('busfee');
    var attendedbonus=document.getElementById('attendedbonus');
    var bonus=document.getElementById('bonus');
    var rarecost=document.getElementById('rarecost');

    rarecost.addEventListener('input',function(){
        var amount=parseFloat( basicsalary.value) + parseFloat( busfee.value) + parseFloat( attendedbonus.value) + parseFloat( bonus.value) + parseFloat( rarecost.value);
        firsttotal.value=amount;
        var amount2=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount2;

    })
    bonus.addEventListener('input',function(){
        var amount=parseFloat( basicsalary.value) + parseFloat( busfee.value) + parseFloat( attendedbonus.value) + parseFloat( bonus.value) + parseFloat( rarecost.value);
        firsttotal.value=amount;
        var amount2=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount2;

    })
    attendedbonus.addEventListener('input',function(){
        var amount=parseFloat( basicsalary.value) + parseFloat( busfee.value) + parseFloat( attendedbonus.value) + parseFloat( bonus.value) + parseFloat( rarecost.value);
        firsttotal.value=amount;
        var amount2=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount2;

    })
    busfee.addEventListener('input',function(){
        var amount=parseFloat( basicsalary.value) + parseFloat( busfee.value) + parseFloat( attendedbonus.value) + parseFloat( bonus.value) + parseFloat( rarecost.value);
        firsttotal.value=amount;
        var amount2=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount2;

    })



    var other=document.getElementById('other');
    var otherlabel=document.getElementById('otherlabel');
    var redeem=document.getElementById('redeem');
    var fine=document.getElementById('fine');
    var ssbfee=document.getElementById('ssbfee');
    var absence=document.getElementById('absence');
    var mealdeduct=document.getElementById('mealdeduct');
    var advancesalary=document.getElementById('advancesalary');

    other.addEventListener('input',function(){
         var amount=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount;

    });
    redeem.addEventListener('input',function(){
         var amount=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount;
    });
    fine.addEventListener('input',function(){
         var amount=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount;
    });
    ssbfee.addEventListener('input',function(){
         var amount=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount;
    });
    absenceday.addEventListener('input',function(){
         var amount=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount;
    });
    mealdeduct.addEventListener('input',function(){
         var amount=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount;
    });
    advancesalary.addEventListener('input',function(){
         var amount=parseFloat(firsttotal.value)-(parseFloat(other.value)+parseFloat(redeem.value)+parseFloat(fine.value)+parseFloat(ssbfee.value)+parseFloat(absence.value)+parseFloat(mealdeduct.value)+parseFloat(advancesalary.value));
         finalTotal.value=amount;
    });
    //firsttotal change တာနဲ့ final total ပါလိုက် change
    function cancleform(){
      window.location.href="/salaries";
    }

  </script>
  {{-- edit salary modal end --}}
@endsection
