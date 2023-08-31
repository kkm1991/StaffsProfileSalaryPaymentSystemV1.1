@extends('layouts/app')
@section('content')
<style>
     
     @media print {
    body * {
      visibility: hidden;
    }
     .printM,
     .printM * {
      visibility: visible;
    }
    .modal-footer {
      display: none;
    }
    .printM {
      position: absolute;
      left: 0;
      top: 0;
    }
    
  }
  
     .modal-dialog {
    max-width: 80mm;
  }

  .modal-content {
    border-radius: 0;
  }

  .modal-header {
    background-color: #f2f2f2;
    border-bottom: none;
  }

  .modal-body {
    padding: 20px;
  }

  .modal-body .row {
    margin-bottom: 20px;
  }

  .modal-body .col:first-child {
    font-weight: bold;
  }

  .modal-footer {
    border-top: none;
  }
</style>
    <div class="container" >
        <div class="row">
            @if(session('deleted'))
            <div id="session-alert" class="alert alert-success">{{session('deleted')}}</div>
            @endif
            @if(session('warning'))
            <div id="session-alert" class="alert alert-warning">{{session('warning')}}</div>
            @endif
            

            <div class="card ng-white shadow-sm"style="padding: 10px; margin:10px;">
                <form action="" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-6" >
                            <label>ဌာနရွေးပါ</label>
                            <select name="searchby" id="" class="form-control">
                                <option value="" selected></option>
                                @foreach($depforoption as $dep)
                                <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6" >
                            <label>SELECT DATE</label>
                            <input class="form-control" type="month" id="monthPicker" name="monthPicker" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                        </div>
                    </div>
                    <div class="row">
                        <br>
                    </div>

                    <div class="row"  >
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block" id="btnsearch" name="action" value="search">ဌာနအလိုက်ရှာရန်</button>
                            <button type="submit" class="btn btn-primary btn-block"id="btnprint" name="action" value="print">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1 feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Print</button>
                        </div>
                        
                    </div>
                </form>        
            </div> 
         </div> 
            <table class="table table-hover">
                <thead class="table-dark">
                    <th scope="col">နေ့စွဲ</th>
                    <th scope="col">အမည်</th>
                    <th scope="col">ဌာန</th>
                    <th scope="col">အခြေခံလစာ</th>
                    <th scope="col">ရှားပါးစာရိတ်</th>
                    <th scope="col">Bonus</th>
                    <th scope="col">ရက်မှန်ကြေး</th>
                    <th scope="col">ကားခ</th>
                    <th scope="col">လစာစုစုပေါင်း</th>

                    <th scope="col">လစာကြိုထုတ်</th>
                    <th scope="col">ထမင်းဖိုး</th>
                    <th scope="col">အလုပ်ပျက်ရက်နူတ်</th>
                    <th scope="col">လူမှု့ဖူလုံရေး</th>
                    <th scope="col">ဒဏ်ကြေး</th>
                    <th scope="col">ဝန်ထမ်းချေးငွေဆပ်</th>
                    <th scope="col">အခြားနူတ်ငွေခေါင်းစဉ်</th>
                    <th scope="col">နူတ်ငွေ</th>
                    <th scope="col" >စုစုပေါင်းလစာ</th>
                    <th scope="col" ></th>
                    <th scope="col"></th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach($salaries as $salary)
                    @php
                     $profilename=$salary->profiles->Name
                    @endphp
                  
                    <tr>
                        <td style="color: #46b31e ;">{{$salary->created_at->format('F Y')}}</td>
                        <td style="font-weight: bold;">{{$salary->profiles->Name}}</td>
                        <td style="font-weight: bold;">{{$salary->deps->dep_name}}</td>
                        <td style="color: #46b31e ;">{{$salary->basicSalary}}</td>
                        <td style="color: #46b31e ;">{{$salary->rareCost}}</td>
                        <td style="color: #46b31e ;">{{$salary->bonus}}</td>
                        <td style="color: #46b31e ;">{{$salary->attendedBonus}}</td>
                        <td style="color: #46b31e ;">{{$salary->busFee}}</td>
                        <td style="color: blue; font-weight: bold;">{{$salary->First_Total}}</td>

                         <td style="color: #e40505 ;"> {{$salary->advance_salary}} </td>
                        <td style="color: #e40505 ;"> {{$salary->mealDeduct}} </td>
                        <td style="color: #e40505 ;">{{$salary->absence}} </td>
                        <td style="color: #e40505 ;">{{$salary->ssbFee}} </td>
                        <td style="color: #e40505 ;">{{$salary->fine}} </td>
                        <td style="color: #e40505 ;"> {{$salary->redeem}} </td>
                        <td style="font-weight: bold;"> {{$salary->otherDeductLable}}</td>
                        <td style="color: #e40505 ;"> {{$salary->otherDeduct}}</td>
                        <td style="color: blue; font-weight: bold;"> {{$salary->Final_Total}}</td>
                        <td > <a href="{{url("/salary/delete/$salary->id?profileName=$profilename")}}" class="btn btn-sm p-0"><img src="{{asset("storage/logos/delete_cycle.png")}}"  alt="Logo"width="30" height="30"></a></td>
                        <!-- payslip button and modal -->
                        <td><button class="btn btn-sm p-0" data-bs-toggle="modal" data-bs-target="#payslipModal{{$salary->id}}"><img src="{{asset("storage/logos/images.png")}}"  alt="Logo"width="30" height="30"></button></td>
                        <div class="modal printM fade" id="payslipModal{{$salary->id}}" tabindex="-1" aria-labelledby="payslipModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
        
                                </div>
                                <div class="modal-body">
                                    <label for="" style="text-align: center; font-weight: bold;text-decoration: underline;">{{$salary->created_at->format('F Y')}} လစာ</label>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">ဝန်ထမ်းအမည်</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->profiles->Name}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">ဌာန</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->deps->dep_name}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">အခြေခံလစာ</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->basicSalary}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">ရှားပါးစရိတ်</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->rareCost}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">ချီးမြင့်ငွေ</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->bonus}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">ရက်မှန်ကြေး</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->attendedBonus}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">ကားခ</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->busFee}}
                                    </div>
                                 </div>
                                 <div class="row"style="font-weight:bold">
                                    <div class="col">
                                        <label for="">လစာစုစုပေါင်း</label>
                                    </div>
                                    <div class="col" style="font-weight:bold">
                                        {{$salary->First_Total}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">ထမင်းဖိုး</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->mealDeduct}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">အလုပ်ပျက်ရက်နူတ်</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->absence}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">လူမှု့ဖူလုံရေး</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->ssbFee}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">ဒဏ်ကြေး</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->fine}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">ချေးငွေဆပ်</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->redeem}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="">အခြားနူတ်ငွေ</label>
                                    </div>
                                    <div class="col">
                                        {{$salary->otherDeductLable}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for=""></label>
                                    </div>
                                    <div class="col">
                                        {{$salary->otherDeduct}}
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <label for="" style="font-weight: bold">စုစုပေါင်းလစာ</label>
                                    </div>
                                    <div class="col"style="font-weight: bold">
                                        {{$salary->Final_Total}}
                                    </div>
                                 </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button class="btn btn-primary" onclick="window.print()"><img src="{{asset("storage/logos/printer.png")}}"  alt="Logo"width="25" height="25"></a></button>
                                </div>
                              </div>
                            </div>
                          </div>
                    </tr>
                    <tr>
                        @php
                            $totalsalarybydep=0;
                            $totalsalarybydep+=$salary->Final_Total;
                        @endphp
                         
                         
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex float-end ">
                 @if(isset($showtotal))
                 <div id="deptotallable" class=" deptotallable fw-bolder text-primary   p-2 m-1 text-weight">  {{$deps->dep_name}} လစာစုစုပေါင်း</div> 
                 <div id="totalamount"class="totalamount fw-bolder text-primary   p-2 m-1">  {{$totalsalarybydep}} </div>
                 @endif
                
                 
            </div>
    </div>
 <script>
    var setlable= document.querySelector(".deptotallable");
    var setamount=document.querySelector(".totalamount");
    document.getElementById("btnsearch").addEventListener("click",function(){
        setlable.innerHTML= "" ;
        setamount.innerHTML=  ;
    });
 </script>
@endsection