@extends('layouts/app')
@section('content')
<style>
        /* Custom CSS to make the table transparent */
        .transparent-table {
            background-color: transparent;
            opacity: 0.7; /* Adjust the opacity as needed */
            color: black; /* Change the text color for better visibility */
            width:100%;
        }
        .transparent-table th,
        .transparent-table td {
            padding: 10px; /* Add padding to table cells */
            text-align: center; /* Center-align text in cells */
            border: 1px solid #ccc; /* Add border to table cells */
        }
        
    </style>
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
        <div class="card custom-background-opacity border-0 shadow">
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
                <div class=" " >
                    <table class="transparent-table border-1 shadow"  id="myTable" >
                        <thead class="custom-background-opacity text-success">
                            <tr  >
                                <th  >ID</th>
                                <th  >အမည်</th>
                                <th >ဌာန</th>
                                <th >ရာထူး</th>
                                <th >အခြေခံလစာ</th>
                                <th >ချေးငွေ(အကြွေး)</th>
                                <th>ကြိုတင်စာရင်းထဲ့ရန် / လစာပေးရန်</th>
                                 


                            </tr>
                        </thead>

                        <!-- Add more rows and data here -->
                        <tbody  >
                            @foreach ($profiles as $profile)
                            <tr  class="fw-bolder">
                            <td>{{$profile->id}}</th>
                            <td>{{$profile->Name}}</th>
                            <td>{{$profile->workingdeps->dep_name}}</th>
                            <td>{{$profile->positions->position_name}}</th>
                            <td  >{{$profile->BASIC_SALARY}}</th>
                            <td  >{{$profile->DEBT}}</th>

                            <td ><a href="{{url("/reservation/$profile->id")}}" class="btn btn-warning btn-sm "> ကြိုတင်စာရင်းထဲ့ရန် </a>   {{" "}}

                                <a href="{{url("/paysalary/$profile->id?basic_salary=$profile->BASIC_SALARY&work_dep=$profile->WORK_DEP ")}}" class="btn btn-success btn-sm "> လစာပေးရန် </a></td>

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
