@extends('layouts/app')

@section('content')
  <div class="container">
    <div class="card shadow rounded w-50 mb-3 ">
        <div class="row">
            <div class="col-11">
                <form action="" method="get">
                    @csrf
                    <label for="floatingmonthPicker" class="p-3">ကြိုတင်စာရင်းပြန်ကြည့်ရန် နှစ်/လရွေးပါ</label>
                    <input class="form-control ms-3 mb-3  " type="month" id="floatingmonthPicker" name="monthPicker"> 
                    <button type="submit" class="  btn btn-outline-success ms-3 mb-3">ရှာရန်</button>
                </form>   
                                                              
            </div>
        </div>
    </div>
    
    <div class="card shadow">

        <div class="form-floating m-2">
            <textarea class="form-control" onkeyup="searchfunction()" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">ဝန်ထမ်းအမည်နှင့်ရှာရန်</label>
        </div>
         
        <div class=" m-2">
            @php
                $count=0;
                $rareCost=0;
                $bonus=0;
                $attendedBonus=0;
                $busFee=0;
                $advance_salary=0;
                $mealDeduct=0;
                $absence=0;
                $ssbFee=0;
                $fine=0;
                $redeem=0;
                $otherDeduct=0;
                foreach ($reservation as $reservationData) {
                  $count=$count+1;
                  $rareCost+= $reservationData->rareCost  ;
                  $bonus+= $reservationData->bonus;
                  $attendedBonus+= $reservationData->attendedBonus;
                  $busFee+= $reservationData->busFee;
                  $advance_salary+= $reservationData->advance_salary;
                  $mealDeduct+= $reservationData->mealDeduct;
                  $absence+= $reservationData->absence;
                  $ssbFee+= $reservationData->ssbFee;
                  $fine+= $reservationData->fine;
                  $redeem+= $reservationData->redeem;
                  $otherDeduct+= $reservationData->otherDeduct;
                }
            @endphp
        </div>
        <table class=" table table-hover table-bordered" id="myTable">
            <thead class="table-success">
                <th>အမည်</th>
                <th>ဌာန</th>
                <th>ရှားပါးစာရိတ်</th>
                <th>Bonus</th>
                <th>ရက်မှန်ကြေး</th>
                <th>ကားခ</th>
                <th>လစာကြိုထုတ်</th>
                <th>ထမင်းဖိုး</th>
                <th>အလုပ်ပျက်ရက်နူတ်</th>
                <th>လူမှု့ဖူလုံရေး</th>
                <th>ဒဏ်ကြေး</th>
                <th>ဝန်ထမ်းချေးငွေဆပ်</th>
                <th>အခြားနူတ်ငွေခေါင်းစဉ်</th>
                <th>နူတ်ငွေ</th>
                <th>စာရင်းသွင်းရက်စွဲ</th>
                <th>Action</th>
            </thead>
           <tbody>
                    @foreach($reservation as $reservationData)
                       
                         <tr>
                           <input type="hidden" name="ReservationId" value="{{$reservationData->id}}">
                            <td class="fw-bold  ">{{$reservationData->staffprofile->Name}}</td>
                            <td class="fw-bold ">{{$reservationData->staffprofile->workingdeps->dep_name}}</td>
                            <td class="fw-bold ">{{$reservationData->rareCost }}</td>
                            <td class="fw-bold ">{{$reservationData->bonus }}</td>
                            <td class="fw-bold ">{{$reservationData->attendedBonus }}</td>
                            <td class="fw-bold ">{{$reservationData->busFee }}</td>

                            <td class="fw-bold ">{{$reservationData->advance_salary }}</td>
                            <td class="fw-bold ">{{$reservationData->mealDeduct }}</td>
                            <td class="fw-bold ">{{$reservationData->absence }}</td>
                            <td class="fw-bold ">{{$reservationData->ssbFee }}</td>
                            <td class="fw-bold ">{{$reservationData->fine }}</td>
                            <td class="fw-bold ">{{$reservationData->redeem }}</td>
                            <td class="fw-bold ">{{$reservationData->otherDeductLable }}</td>
                            <td class="fw-bold ">{{$reservationData->otherDeduct }}</td>
                            <td class="fw-bold ">{{$reservationData->created_at->format('d M Y') }}</td>
                            <td class="fw-bold "><button type="button"class="btn btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#reservationEditModal{{$reservationData->id}}" >Edit</button></td>
                         </tr>
                        
                         {{-- edit reservation modal start --}}
  <div class="modal fade" id="reservationEditModal{{$reservationData->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <form action="/default/update/{{$reservationData->id}}" method="POST">
            @csrf
            <input type="hidden" name="reservationId" value="{{$reservationData->id}}">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$reservationData->staffprofile->Name}} : {{$reservationData->staffprofile->workingdeps->dep_name}} : ID - {{$reservationData->id}} </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  
                <h5 class="card-title text-success fw-bold">လစာပေါင်းငွေ</h5>
                     
                    <div class="mb-3">
                        <label for="rareCost" class="form-label">ရှားပါးစရိတ်</label>
                        <input type="text" id="rareCost" name="rareCost" class="form-control" value="{{$reservationData->rareCost }}" >
                    </div>
                    <div class="mb-3">
                        <label for="bonus" class="form-label">ချီးမြင့်ငွေ</label>
                        <input type="text" id="bonus" name="bonus" class="form-control"  value="{{$reservationData->bonus }}" >
                    </div>
                    <div class="mb-3">
                        <label for="attendedBonus" class="form-label">ရက်မှန်ကြေး</label>
                        <input type="text" id="attendedBonus" name="attendedBonus" class="form-control" value="{{$reservationData->attendedBonus }}"  >
                    </div>
                    <div class="mb-3">
                        <label for="busFee" class="form-label">ကားခ</label>
                        <input type="text" id="busFee" name="busFee" class="form-control" value="{{$reservationData->busFee }}"  >
                    </div>
                    <hr>
                     
                    <h5 class="card-title text-danger fw-bold">ဖြတ်တောက်ငွေ</h5>
                    <div class="mb-3">
                        <label for="advanceSalary" class="form-label">ကြိုတင်လစာယူငွေ</label>
                        <input type="text" id="advanceSalary" name="advanceSalary" class="form-control" value="{{$reservationData->advance_salary }}">
                    </div>

                <div class="mb-3">
                    <label for="mealDeduct" class="form-label">စားစရိတ်နူတ်</label>
                    <input type="text" id="mealDeduct" name="mealDeduct" class="form-control"value="{{$reservationData->mealDeduct }}" >
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-6">
                            <label for="absence" class="form-label">အလုပ်ပျက်ရက်နူတ်</label>
                            <input type="text" id="absence" name="absence" class="form-control" value="{{$reservationData->absence }}" >
                        </div>
                        <div class="col-6">
                            <label for="absenceday" class="form-label">အလုပ်ပျက်ရက်ထဲ့ရန်</label>
                            <input type="text" id="absenceday"    name="absenceday" class="form-control"placeholder="အလုပ်ပျက်ရက်ထဲ့ပါ" value="" >
                            <script>                            
                                    var absence=document.getElementById('absence');
                                    var absenceday=document.getElementById('absenceday');        
                                    absenceday.addEventListener('input',function(){                                     
                                            var amount=parseInt(absenceday.value)*({{$reservationData->staffprofile->BASIC_SALARY}}/30);
                                            absence.value=amount;                                                                                                                  
                                    });                                                                   
                            </script>
                        </div>
                    </div>    
                </div>
                <div class="mb-3">
                    <label for="ssbFee" class="form-label">လူမှု့ဖူလုံရေ</label>
                    <input type="text" id="ssbFee" name="ssbFee" class="form-control" value="{{$reservationData->ssbFee }}" >
                </div>
                <div class="mb-3">
                    <label for="fine" class="form-label">ဒဏ်ကြေး</label>
                    <input type="text" id="fine" name="fine" class="form-control" value="{{$reservationData->fine }}" >
                </div>
                <div class="mb-3">
                    <label for="redeem" class="form-label">ချေးငွေဆပ်</label>
                    <input type="text" id="redeem" name="redeem" class="form-control" value="{{$reservationData->redeem }}" >
                </div>
                <div class="mb-3">
                    <label for="otherDeduct" class="form-label">အခြားနူတ်ငွေ</label>
                    <input type="text" id="otherDeductLable" name="otherDeductLable" class="form-control" value="{{$reservationData->otherDeductLable }}" placeholder="အကြောင်းအရာထဲ့ပါ"> <br>
                    <input type="text" id="otherDeduct" name="otherDeduct" class="form-control" value="{{$reservationData->otherDeduct }}" >
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>
        
      </div>
    </div>
  </div>
</div>
  {{-- edit reservation modal end --}}

                    @endforeach
           </tbody>

           <tfoot class="table table-warning">
                <th> {{$count}}ယောက် </th>
                <th> </th>
                <th>{{$rareCost}}</th>
                <th>{{$bonus}} </th>
                <th>{{$attendedBonus}}</th>
                <th>{{$busFee}}</th>
                <th>{{$advance_salary}}</th>
                <th>{{$mealDeduct}}</th>
                <th>{{$absence}}</th>
                <th>{{$ssbFee}}</th>
                <th>{{$fine}}</th>
                <th>{{$redeem}}</th> 
                <th></th>
                <th>{{$otherDeduct}}</th>
                <th></th>
                <th></th>
           </tfoot>
        </table>
       
  </div>
  <script>
    function searchfunction(){
         // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("floatingTextarea");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script> 
  
@endsection