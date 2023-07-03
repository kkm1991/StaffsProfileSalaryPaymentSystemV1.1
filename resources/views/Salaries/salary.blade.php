@extends('layouts/app')
@section('content')
 
    <div class="container" >
        <div class="row">
            @if(session('deleted'))
            <div id="session-alert" class="alert alert-success">{{session('deleted')}}</div>
            @endif
            @if(session('warning'))
            <div id="session-alert" class="alert alert-warning">{{session('warning')}}</div>
            @endif
                <form action="" method="get">
                    @csrf
                    <div class="input-group"> 
                        <select name="searchby" id="" class="form-control">
                            <option value="" selected> </option>
                            @foreach($deps as $dep)
                            <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                            @endforeach
                        </select>
                        <input class="form-control" type="month" id="monthPicker" name="monthPicker" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                        <button type="submit" class="btn btn-primary">ဌာနအလိုက်ရှာရန်</button>
                    </div>
                    
                </form>
        
            
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
                    <th style="background-color: #46b31e; color: #333; padding: 8px; text-align: left; border-bottom: 1px solid #ddd;border-top-right-radius: 5px;">Action</th>
                </thead>
                <tbody>
                    @foreach($salaries as $salary)
                    @php
                     $profilename=$salary->profiles->Name
                    @endphp
                  
                    <tr>
                        <td style="color: #46b31e ;">{{$salary->created_at}}</td>
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
                        <td > <a href="{{url("/salary/delete/$salary->id?profileName=$profilename")}}" class="btn btn-sm"><img src="{{asset("storage/logos/delete_cycle.png")}}"  alt="Logo"width="25" height="25"></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
    </div>
 
@endsection