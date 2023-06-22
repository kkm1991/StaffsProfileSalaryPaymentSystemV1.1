@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            @foreach($showreservation as $showreserve)
            
            <div class="card-header">
                Reservation of - Staff   : {{$staffid->Name}} Created:  {{$showreserve->created_at->diffForHumans()}}
            </div>
            <div class="card-body">
                <form action="{{url('/reservation/update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="reservation_id"id="reservation_id" value="{{$showreserve->id}}">
                    <h5 class="card-title">လစာပေါင်းငွေ</h5>
                     
                    <div class="mb-3">
                        <label for="rareCost" class="form-label">ရှားပါးစရိတ်</label>
                        <input type="text" id="rareCost" name="rareCost" class="form-control" value="{{$showreserve->rareCost}}"  >
                    </div>
                    <div class="mb-3">
                        <label for="bonus" class="form-label">ချီးမြင့်ငွေ</label>
                        <input type="text" id="bonus" name="bonus" class="form-control" value="{{$showreserve->bonus}}"  >
                    </div>
                    <div class="mb-3">
                        <label for="attendedBonus" class="form-label">ရက်မှန်ကြေး</label>
                        <input type="text" id="attendedBonus" name="attendedBonus" class="form-control" value="{{$showreserve->attendedBonus}}"  >
                    </div>
                    <div class="mb-3">
                        <label for="busFee" class="form-label">ကားခ</label>
                        <input type="text" id="busFee" name="busFee" class="form-control"  value="{{$showreserve->busFee}}" >
                    </div>
                     
                    <h5 class="card-title">ဖြတ်တောက်ငွေ</h5>
                <div class="mb-3">
                    <label for="mealDeduct" class="form-label">စားစရိတ်နူတ်</label>
                    <input type="text" id="mealDeduct" name="mealDeduct" class="form-control" value="{{$showreserve->mealDeduct}}" >
                </div>
                <div class="mb-3">
                    <label for="absence" class="form-label">အလုပ်ပျက်ရက်နူတ်</label>
                    <input type="text" id="absence" name="absence" class="form-control" value="{{$showreserve->absence}}" >
                </div>
                <div class="mb-3">
                    <label for="ssbFee" class="form-label">လူမှု့ဖူလုံရေ</label>
                    <input type="text" id="ssbFee" name="ssbFee" class="form-control" value="{{$showreserve->ssbFee}}" >
                </div>
                <div class="mb-3">
                    <label for="fine" class="form-label">ဒဏ်ကြေး</label>
                    <input type="text" id="fine" name="fine" class="form-control"  value="{{$showreserve->fine}}">
                </div>
                <div class="mb-3">
                    <label for="redeem" class="form-label">ချေးငွေဆပ်</label>
                    <input type="text" id="redeem" name="redeem" class="form-control"  value="{{$showreserve->redeem}}">
                </div>
                <div class="mb-3">
                    <label for="otherDeduct" class="form-label">အခြားနူတ်ငွေ</label>
                    <input type="text" id="otherDeductLable" name="otherDeductLable" class="form-control" value="{{$showreserve->otherDeductLable}}" placeholder="အကြောင်းအရာထဲ့ပါ"> <br>
                    <input type="text" id="otherDeduct" name="otherDeduct" class="form-control" value="{{$showreserve->otherDeduct}}" >
                </div>

                    <input type="submit" value="Save" class="btn btn-success"> 
                    <button type="button" class="btn btn-secondary" onclick="cancelForm()">Cancel</button> <br>
                </form>
                 <script>
                    function cancelForm(){
                        window.location.href="/paymentlist";
                    }
                 </script> 
                 @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
