@extends('layouts/app')
@section('content')
<div class="container"  >
    
     {{ $profiles->links()}} 
    <div class="row" >
        <div class="card">
           
            <div class="card-header">
        
            
              <form action="/" method="get">
              
                <div class="input-group">
                    <select name="searchby" id="" class="form-control">
                        <option value="" selected></option>
                        @foreach($deps as $dep)
                        <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">ဌာနအလိုက်ရှာရန်</button><br>
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
                                <th  >အဖအမည်</th>
                                <th  >မှတ်ပုံတင်အမှတ်</th>
                                <th  >မွေးနေ့</th>
                                <th  >ပညာအရည်အချင်း</th>
                                <th >ဌာန</th>
                                <th >ရာထူး</th>
                                <th >အခြေခံလစာ</th>
                                <th >ချေးငွေ(အကြွေး)</th>
                                
                                <th >ဓါတ်ပုံ</th>
                                <th >အခြေအနေ</th>
                            </tr>
                        </thead>
                        
                        <!-- Add more rows and data here -->
                        <tbody>
                            @foreach ($profiles as $profile)
                            <tr  >
                            <th  >{{$profile->id}}</th>
                            <th  >{{$profile->Name}}</th>
                            <th  >{{$profile->Father_Name}}</th>
                            <th  >{{$profile->NRC}}</th>
                            <th  >{{$profile->DOB}}</th>
                            <th>{{$profile->educations->education}}</th>
                            <th>{{$profile->workingdeps->dep_name}}</th>
                            <th>{{$profile->positions->position_name}}</th>
                            <th  >{{$profile->BASIC_SALARY}}</th>
                            <th  >{{$profile->DEBT}}</th>
                         
                            <!--ဓါတ်ပုံ-->
                            <th  >
                                <img class="img-thumbnail mb-3" src="{{ asset('storage/staffimages/' . $profile->PHOTO_NAME) }}" alt="{{ $profile->PHOTO_NAME }}" width="200">
                            </th>
                            <!--STATUS ပြင်-->
                            <th  >@if($profile->STATUS==1)
                                <a href="{{url("/status/change/$profile->id")}}" class="btn btn-success small"  >ACTIVE</a>
                            
                                 @elseif($profile->STATUS==0)
                                 <a href="{{url("/status/change/$profile->id")}}" class="btn btn-danger"  >INACTIVE</a>    
                                 @endif
                            </th>
                            <th ><a href="{{url("/profile/edit/$profile->id")}}" class="btn btn-warning"    > EDIT </a></th>



                            <!-- delete button and confirm modal-->
                            <th ><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$profile->id}}">
                                DELETE
                              </button>
                            
                            </th>
                            <div class="modal fade" id="deleteModal{{$profile->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$profile->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="deleteModalLabel{{$profile->id}}">Delete Profile</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <p>Are you sure you want to delete this profile?</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      <a href="{{ url("/profile/delete/$profile->id") }}" class="btn btn-danger">Delete</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
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