@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header text-success ">
                 
            </div>
            <div class="card-body">
                <form action="{{url('/default/create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @php
                        $count=0;
                    @endphp
                    
                     <input type="text" list="staff" class="form-control" id="staff_id" name="staff_id">
                     
                     <datalist id="staff">
                        @foreach ($staffs as $staff)
                                 <option value="{{$staff->id}}">{{$staff->Name}}</option> 
                                @php
                                    $count+=1;
                                @endphp 
                            @endforeach
                     </datalist>

                    
                  


                    <label for="">ဝန်ထမ်းစုစုပေါင်း {{$count}} ယောက်</label>
                    <h5 class="card-title">လစာပေါင်းငွေ</h5>
                     
                    <div class="mb-3">
                        <label for="rareCost" class="form-label">ရှားပါးစရိတ်</label>
                        <input type="text" id="rareCost" name="rareCost" class="form-control" value="0" >
                    </div>
                    <div class="mb-3">
                        <label for="bonus" class="form-label">ချီးမြင့်ငွေ</label>
                        <input type="text" id="bonus" name="bonus" class="form-control"  value="0" >
                    </div>
                    <div class="mb-3">
                        <label for="attendedBonus" class="form-label">ရက်မှန်ကြေး</label>
                        <input type="text" id="attendedBonus" name="attendedBonus" class="form-control" value="0"  >
                    </div>
                    <div class="mb-3">
                        <label for="busFee" class="form-label">ကားခ</label>
                        <input type="text" id="busFee" name="busFee" class="form-control" value="0"  >
                    </div>
                    <hr>
                     
                    <h5 class="card-title">ဖြတ်တောက်ငွေ</h5>
                    <div class="mb-3">
                        <label for="advanceSalary" class="form-label">ကြိုတင်လစာယူငွေ</label>
                        <input type="text" id="advanceSalary" name="advanceSalary" class="form-control" value="0">
                    </div>

                <div class="mb-3">
                    <label for="mealDeduct" class="form-label">စားစရိတ်နူတ်</label>
                    <input type="text" id="mealDeduct" name="mealDeduct" class="form-control"value="0" >
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-6">
                            <label for="absence" class="form-label">အလုပ်ပျက်ရက်နူတ်</label>
                            <input type="text" id="absence" readonly name="absence" class="form-control" value="0" >
                        </div>
                        <div class="col-6">
                            <label for="absence" class="form-label">အလုပ်ပျက်ရက်ထဲ့ရန်</label>
                            <input type="text" id="absenceday"  required name="absenceday" class="form-control"placeholder="အလုပ်ပျက်ရက်ထဲ့ပါ" value="0" >
                           
                                    
                                
                            
                        </div>
                    </div>
                    
                    
                </div>
                <div class="mb-3">
                    <label for="ssbFee" class="form-label">လူမှု့ဖူလုံရေ</label>
                    <input type="text" id="ssbFee" name="ssbFee" class="form-control" value="0" >
                </div>
                <div class="mb-3">
                    <label for="fine" class="form-label">ဒဏ်ကြေး</label>
                    <input type="text" id="fine" name="fine" class="form-control" value="0" >
                </div>
                <div class="mb-3">
                    <label for="redeem" class="form-label">ချေးငွေဆပ်</label>
                    <input type="text" id="redeem" name="redeem" class="form-control" value="0" >
                </div>
                <div class="mb-3">
                    <label for="otherDeduct" class="form-label">အခြားနူတ်ငွေ</label>
                    <input type="text" id="otherDeductLable" name="otherDeductLable" class="form-control" value="မရှိ" placeholder="အကြောင်းအရာထဲ့ပါ"> <br>
                    <input type="text" id="otherDeduct" name="otherDeduct" class="form-control" value="0" >
                </div>

                    <input type="submit" value="Save" class="btn btn-success"> 
                    <button type="button" class="btn btn-secondary" onclick="cancelForm()">Cancel</button> <br>
                </form>
                 <script>
                    function cancelForm(){
                        window.location.href="/default";
                    }
                 </script> 
            </div>
        </div>
    </div>
</div>


@endsection
