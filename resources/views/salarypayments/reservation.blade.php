@extends('layouts/app')
@section('content')
        <!-- Form -->
        <form action=" " method="post" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <!-- လစာပေါင်းငွေ -->
            <div class="card bg-primary">
                <div class="card-body">
                    @foreach($showreserve as $reservation) 
                        
                    
                    <h5 class="card-title">လစာပေါင်းငွေ</h5>
                     
                    <div class="mb-3">
                        <label for="rareCost" class="form-label">ရှားပါးစရိတ်</label>
                        <input type="text" id="rareCost" name="rareCost" class="form-control" value="{{$reservation->rareCost}}">
                    </div>
                    <div class="mb-3">
                        <label for="bonus" class="form-label">ချီးမြင့်ငွေ</label>
                        <input type="text" id="bonus" name="bonus" class="form-control" value="{{$reservation->bonus}}">
                    </div>
                    <div class="mb-3">
                        <label for="attendedBonus" class="form-label">ရက်မှန်ကြေး</label>
                        <input type="text" id="attendedBonus" name="attendedBonus" class="form-control" value="{{$reservation->attendedBonus}}">
                    </div>
                    <div class="mb-3">
                        <label for="busFee" class="form-label">ကားခ</label>
                        <input type="text" id="busFee" name="busFee" class="form-control" value="{{$reservation->busFee}}">
                    </div>
                </div>
            </div>
            <br>
           <!-- ဖြတ်တောက်ငွေ -->
           <div class="card bg-danger">
            <div class="card-body">
                <h5 class="card-title">ဖြတ်တောက်ငွေ</h5>
                <div class="mb-3">
                    <label for="mealDeduct" class="form-label">စားစရိတ်နူတ်</label>
                    <input type="text" id="mealDeduct" name="mealDeduct" class="form-control" value="{{$reservation->mealDeduct}}">
                </div>
                <div class="mb-3">
                    <label for="absence" class="form-label">အလုပ်ပျက်ရက်နူတ်</label>
                    <input type="text" id="absence" name="absence" class="form-control" value="{{$reservation->absence}}">
                </div>
                <div class="mb-3">
                    <label for="ssbFee" class="form-label">လူမှု့ဖူလုံရေ</label>
                    <input type="text" id="ssbFee" name="ssbFee" class="form-control" value="{{$reservation->ssbFee}}">
                </div>
                <div class="mb-3">
                    <label for="fine" class="form-label">ဒဏ်ကြေး</label>
                    <input type="text" id="fine" name="fine" class="form-control" value="{{$reservation->fine}}">
                </div>
                <div class="mb-3">
                    <label for="redeem" class="form-label">ချေးငွေဆပ်</label>
                    <input type="text" id="redeem" name="redeem" class="form-control" value="{{$reservation->redeem}}">
                </div>
                <div class="mb-3">
                    <label for="otherDeduct" class="form-label">အခြားနူတ်ငွေ</label>
                    <input type="text" id="otherDeductLable" name="otherDeductLable" class="form-control" value="" placeholder="{{$reservation->otherDeductLable}}"> <br>
                    <input type="text" id="otherDeduct" name="otherDeduct" class="form-control" value="{{$reservation->otherDeduct}}">
                </div>
            </div>
        </div>

        </div>
        @endforeach
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning">သိမ်းမည်</button>
        </div>
    </form>
    @endsection