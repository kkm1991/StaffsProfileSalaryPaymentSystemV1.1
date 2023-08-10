@extends('layouts/app')
@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .print-container,
        .print-container * {
            visibility: visible;
        }
        
        .print-container {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
    .center-heading{
        text-align: center;
        font-weight: bold;
        text-decoration: underline;
    }
    .table{
        border-collapse: collapse;
    width: 100%;
    font-family: Arial, sans-serif;
    color: #333;
    }
    th{
        background-color: #f2f2f2;
        border:1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    
  td {
    border: 1px solid #ddd;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  tr:hover {
    background-color: #e9e9e9;
  }
</style>
    <div class="print-container">
        
       <h5 class="center-heading"><img src="{{asset("storage/logos/MZTMlogo.jpg")}}"  alt="Logo"width="50" height="50"> MitzuTunMyint Co.,ltd ဝန်ထမ်းများ လစာပေးစာရင်း</h5>
       <div class=" float-end p-2 ms-5 mb-2 fw-bolder border border-info rounded-pill ">{{$datemonth}} လ {{$deps->dep_name}} အတွက်  </div>
        
       
        <table class="table" id="table">
            <thead class="table-head">
                <th  >စဉ်</th>
                <th  >အမည်</th>
                 
                <th  >အခြေခံလစာ</th>
                <th  >ရှားပါးစာရိတ်</th>
                <th  >Bonus</th>
                <th  >ရက်မှန်ကြေး</th>
                <th  >ကားခ</th>
                <th  >လစာစုစုပေါင်း</th>
                <th  >ထမင်းဖိုး</th>
                <th  >အလုပ်ပျက်ရက်နူတ်</th>
                <th  >လူမှု့ဖူလုံရေး</th>
                <th >ဒဏ်ကြေး</th>
                <th  >ဝန်ထမ်းချေးငွေဆပ်</th>
                <th  >အခြားနူတ်ငွေခေါင်းစဉ်</th>
                <th  >နူတ်ငွေ</th>
                <th  >စုစုပေါင်းလစာ</th>
                
            </thead>
            <tbody>
                @php
                $totalsum=0;
                $c=0;
                
                @endphp
                @foreach($salaries as $salary)
                
                @php
                 $c+=1;
                @endphp
             <!-- {{$salary->created_at->format('F Y')}}-->
                <tr>
                    <td class="fw-bold">{{$c}}</td>
                    <td style="font-weight: bold">{{$salary->profiles->Name}}</td>
                    
                    <td class="fw-bold">{{$salary->basicSalary}}</td>
                    <td class="fw-bold text-success">{{$salary->rareCost}}</td>
                    <td class="fw-bold text-success">{{$salary->bonus}}</td>
                    <td class="fw-bold text-success">{{$salary->attendedBonus}}</td>
                    <td class="fw-bold text-success">{{$salary->busFee}}</td>
                    <td style="color: 000000; font-weight: bold;">{{$salary->First_Total}}</td>
                    
                    <td class="fw-bold text-danger"> {{$salary->mealDeduct}} </td>
                    <td class="fw-bold text-danger">{{$salary->absence}} </td>
                    <td class="fw-bold text-danger">{{$salary->ssbFee}} </td>
                    <td class="fw-bold text-danger">{{$salary->fine}} </td>
                    <td class="fw-bold text-danger"> {{$salary->redeem}} </td>
                    <td class="fw-bold "> {{$salary->otherDeductLable}}</td>
                    <td class="fw-bold text-danger"> {{$salary->otherDeduct}}</td>
                    <td class="fw-bold"> {{$salary->Final_Total}}</td>
                     @php
                     $totalsum+=$salary->Final_Total
                     @endphp
                     
                </tr>
                @endforeach
                <tr>
                    <td  > </td>
                     
                    <td  > </td>
                    <td  > </td>
                    <td  > </td>
                    <td  > </td>
                    <td  > </td>
                    <td  > </td>
                    <td  > </td>
                    
                    <td  > </td>
                    <td  > </td>
                    <td  > </td>
                    <td  > </td>
                    <td  > </td>
                    <td  > </td>
                    <td  class=" fw-bold bg-success">စုစုပေါင်း </td>
                    <td class="fw-bold bg-warning"> {{$totalsum}} </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="text-center mt-3">
        <button class="btn btn-primary" onclick="window.print()"><img src="{{asset("storage/logos/printer.png")}}"  alt="Logo"width="25" height="25"></a></button>
        <button class="btn btn-primary" onclick="cancleform()">Cancle</button>
    </div>
    <script>
        function cancleform(){
            window.location.href="/salaries";
        }
    </script>
@endsection