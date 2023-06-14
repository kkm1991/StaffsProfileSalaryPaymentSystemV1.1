@extends('layouts/app')
@section('content')
@php
    use Illuminate\Support\Facades\Session;
@endphp
<div class="container"  >
    
     
    <div class="row" >
        <div class="card">
            <div class="card-header">
              <form action="/paymentlist" method="get">
                <div class="input-group">
                    <select name="searchby" id="" class="form-control">
                        <option value="" selected></option>
                        @foreach($deps as $dep)
                        <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>  
                   
                
            </div>
            <div class="card-body">
                @if(session('success')) <!-- profile deleted alert -->
                    <div class="alert alert-info">{{session('success')}}</div>
                @endif
                <div class="table-responsive">
                    <table class="table"  >
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
                            <tr  >
                            <th  >{{$profile->id}}</th>
                            <th  >{{$profile->Name}}</th>
                            <th>{{$profile->workingdeps->dep_name}}</th>
                            <th>{{$profile->positions->position_name}}</th>
                            <th  >{{$profile->BASIC_SALARY}}</th>
                            <th  >{{$profile->DEBT}}</th>
                             
                             
                             
                             
                            <th ><a href="{{url("/salary/reservation/$profile->id")}}" class="btn btn-warning"    > ကြိုတင်စာရင်းထဲ့ရန် </a> </th>
                            
                        </tr>
                            @endforeach
                        </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 

@endsection