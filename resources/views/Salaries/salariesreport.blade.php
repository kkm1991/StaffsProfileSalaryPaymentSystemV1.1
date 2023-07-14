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
        
       <h5 class="center-heading">MitzuTunMyint Co.,ltd ဝန်ထမ်းများ လစာပေးစာရင်း</h5>
        
        <table class="table" id="table">
            <thead class="table-head">
                <th  >နေ့စွဲ</th>
                <th  >အမည်</th>
                <th >ဌာန</th>
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
                @endphp
                @foreach($salaries as $salary)
                @php
                 $profilename=$salary->profiles->Name
                @endphp
              
                <tr>
                    <td style="color: hsl(0, 0%, 0%) ;">{{$salary->created_at->format('F Y')}}</td>
                    <td style="font-weight: bold;">{{$salary->profiles->Name}}</td>
                    <td style="font-weight: bold;">{{$salary->deps->dep_name}}</td>
                    <td style="color: #000000 ;">{{$salary->basicSalary}}</td>
                    <td style="color: #000000 ;">{{$salary->rareCost}}</td>
                    <td style="color: #000000 ;">{{$salary->bonus}}</td>
                    <td style="color: #000000 ;">{{$salary->attendedBonus}}</td>
                    <td style="color: #000000 ;">{{$salary->busFee}}</td>
                    <td style="color: 000000; font-weight: bold;">{{$salary->First_Total}}</td>
                    
                    <td style="color: #000000 ;"> {{$salary->mealDeduct}} </td>
                    <td style="color: #000000 ;">{{$salary->absence}} </td>
                    <td style="color: #000000 ;">{{$salary->ssbFee}} </td>
                    <td style="color: #000000 ;">{{$salary->fine}} </td>
                    <td style="color: #000000 ;"> {{$salary->redeem}} </td>
                    <td style="font-weight: bold;"> {{$salary->otherDeductLable}}</td>
                    <td style="color: #000000 ;"> {{$salary->otherDeduct}}</td>
                    <td style="color: #000000; font-weight: bold;"> {{$salary->Final_Total}}</td>
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
                    <td  > </td>
                    <td  > စုစုပေါင်း </td>
                    <td style="color: #000000; font-weight: bold;"> {{$totalsum}} </td>
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