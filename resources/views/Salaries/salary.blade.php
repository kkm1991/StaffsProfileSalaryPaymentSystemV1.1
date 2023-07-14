@extends('layouts/app')
@section('content')
<style>
     
     @media print {
    body * {
      visibility: hidden;
    }
     #payslipModal,
    #payslipModal * {
      visibility: visible;
    }
    .modal-footer {
      display: none;
    }
    #payslipModal {
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
                                @foreach($deps as $dep)
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
                            <button type="submit" class="btn btn-primary btn-block"name="action" value="search">ဌာနအလိုက်ရှာရန်</button>
                            <button type="submit" class="btn btn-primary btn-block" name="action" value="print">Print</button>
                        </div>
                        
                    </div>
                </form>        
            </div> 
         </div> 
            <table class="table">
                <thead>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;border-top-left-radius: 5px;">နေ့စွဲ</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">အမည်</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">ဌာန</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">အခြေခံလစာ</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">ရှားပါးစာရိတ်</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Bonus</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">ရက်မှန်ကြေး</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">ကားခ</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">လစာစုစုပေါင်း</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">ထမင်းဖိုး</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">အလုပ်ပျက်ရက်နူတ်</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">လူမှု့ဖူလုံရေး</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">ဒဏ်ကြေး</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">ဝန်ထမ်းချေးငွေဆပ်</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">အခြားနူတ်ငွေခေါင်းစဉ်</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">နူတ်ငွေ</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd; ">စုစုပေါင်းလစာ</th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd; "></th>
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;border-top-right-radius: 5px;"></th>
                </thead>
                <tbody>
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
                        
                        <td style="color: #e40505 ;"> {{$salary->mealDeduct}} </td>
                        <td style="color: #e40505 ;">{{$salary->absence}} </td>
                        <td style="color: #e40505 ;">{{$salary->ssbFee}} </td>
                        <td style="color: #e40505 ;">{{$salary->fine}} </td>
                        <td style="color: #e40505 ;"> {{$salary->redeem}} </td>
                        <td style="font-weight: bold;"> {{$salary->otherDeductLable}}</td>
                        <td style="color: #e40505 ;"> {{$salary->otherDeduct}}</td>
                        <td style="color: blue; font-weight: bold;"> {{$salary->Final_Total}}</td>
                        <td > <a href="{{url("/salary/delete/$salary->id?profileName=$profilename")}}" class="btn btn-sm"><img src="{{asset("storage/logos/delete_cycle.png")}}"  alt="Logo"width="50" height="50"></a></td>
                        <!-- payslip button and modal -->
                        <td><button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#payslipModal"><img src="{{asset("storage/logos/images.png")}}"  alt="Logo"width="50" height="50"></button></td>
                        <div class="modal fade" id="payslipModal" tabindex="-1" aria-labelledby="payslipModalLabel" aria-hidden="true">
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
                    @endforeach
                </tbody>
            </table>
    </div>
 
@endsection