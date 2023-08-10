@extends('layouts/app')
@section('content')
 
@php
    use Illuminate\Support\Facades\Session;
@endphp
<div class="container"  >
     
    <div class="row" >
        @if(session('warning')) <!-- profile deleted alert -->
            <div id="session-alert" class="alert alert-warning">{{session('warning')}}
            @endif
            @if(session('alreadypay'))
            <div id="session-alert" class="alert alert-warning">{{session('alreadypay')}}</div>
            @endif
            
            @php
                $count=0;
                foreach ($profiles as $profile) {
                   $count+=1;
                }
            @endphp
        <div class="card">
            <div class="card-header">
              <form action="" method="get">
                <div class="input-group">
                    <select name="searchby" id="" class="form-control">
                        <option value="" selected></option>
                        @foreach($deps as $dep)
                        <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">ဌာနအလိုက်ရှာရန်</button><br>
                    
                </div>
                <div class="card-footer">ဝန်ထမ်းအရေအတွက် {{$count}} ယောက် <input type="text" class="form-control"id="myInput" onkeyup="myFunction()" placeholder="အမည်နှင့်ရှာရန်.."></div>
            </form>  
                   
                
            </div>
            <div class="card-body">
                @if(session('success')) <!-- profile deleted alert -->
                    <div class="alert alert-info">{{session('success')}}</div>
                @endif
                <div class="table-responsive">
                    <table class="table" id="myTable" >
                        <thead>
                            <tr  >
                                <th  >ID</th>
                                <th  >အမည်</th>
                                <th >ဌာန</th>
                                <th >ရာထူး</th>
                                <th >အခြေခံလစာ</th>
                                <th >ချေးငွေ(အကြွေး)</th>
                                 
                                 
                            </tr>
                        </thead>
                        
                        <!-- Add more rows and data here -->
                        <tbody>
                            @foreach ($profiles as $profile)
                            <tr  class="">
                            <td>{{$profile->id}}</th>
                            <td>{{$profile->Name}}</th>
                            <td>{{$profile->workingdeps->dep_name}}</th>
                            <td>{{$profile->positions->position_name}}</th>
                            <td  >{{$profile->BASIC_SALARY}}</th>
                            <td  >{{$profile->DEBT}}</th>
                             
                            <td ><a href="{{url("/reservation/$profile->id")}}" class="btn btn-outline-warning btn-sm "> ကြိုတင်စာရင်းထဲ့ရန် </a>   {{" "}}

                                <a href="{{url("/paysalary/$profile->id?basic_salary=$profile->BASIC_SALARY&work_dep=$profile->WORK_DEP ")}}" class="btn btn-outline-success btn-sm "> လစာပေးရန် </a></td>
                            
                        </tr>
                            @endforeach
                        </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
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