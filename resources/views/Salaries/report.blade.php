@extends('layouts/app')
@section('content')
<style>


@media print {
    body * {
      visibility: hidden;

    }
     #report,
     #report * {
      visibility: visible;
      margin: 0%;
    }
    .cardnotprint{
        display: none;
    }



  }
    #report{
        width: 210mm;
        height: 297mm;

        background-color: #ffffff;
        border: 1px solid #fafafa;
        padding: 10px;
        margin: 10px;
    };


</style>
<div class="container ">

    <div class="card printcard " id="report" style="padding: 10px; margin:2px;" >
        <div  class="card cardnotprint p-2 s " >
            <form action="" method="GET">
                @csrf
                <div class="row">
                    <div class="col">
                         <input class="form-control" type="month" id="monthPicker" name="monthPicker" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                    </div>
                    <div class="col"> <button type="submit" class="btn btn-primary btn-block"name="action" value="search"> လ/နှစ် အလိုက်ရှာရန်</button>  </div>
                </div>
            </form>
        </div>
        <h5 class="center-heading"><img src="{{asset("storage/logos/MZTMlogo.jpg")}}"   alt="Logo"width="50" height="50" > MitzuTunMyint Co.,ltd ဝန်ထမ်းများ လစာပေးစာရင်း</h5>
        <table class="table">
            <thead>
                <th>စဉ်</th>
                <th>ဌာနအမည်</th>
                <th>ဝန်ထမ်းအရေအတွက်</th>
                <th>စုစုပေါင်းလစာ</th>
            </thead>
            <tbody>
                @php
                    $count=0;
                    $total=0;
                    $staffcount=0;
                @endphp
                @foreach ($report as $item)
                <tr>
                    <th> {{$count+=1}}</th>
                     <th>{{$item->dep_name}}</th>
                      <th> {{$item->staff_count}} ယောက်</th>
                    <th>{{$item->total_salary}}
                     @php
                        $total+=$item->total_salary;
                        $staffcount+=$item->staff_count;
                    @endphp
                    </th>
                </tr>
              @endforeach
              <tr class="table-success">
                <th> </th>
                <th>စုစုပေါင်း</th>
               <th>{{$staffcount}} ယောက်</th>
               <th>{{$total}} </th>
              </tr>
              </tbody>
               >
            </table>


    </div>
    <div class="card ng-white shadow-sm" style="width: 210mm; padding:10px; margin:10px">
        <button class="btn btn-primary" onclick="window.print()"><img src="{{asset("storage/logos/printer.png")}}"  alt="Logo"width="25" height="25"></a></button>


    </div>
</div>

@endsection
