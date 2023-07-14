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
.cycle-image {
  border-radius: 25%;
  border: 1px solid #000;
   
}
.staff-card {
  width: 300px; /* Set the desired width */
  height: 400px; /* Set the desired height */
  border: 1px solid #ccc;
  border-radius: 5px;
  
  padding: 20px;
}
</style>

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
                    <button type="submit" class="btn btn-success ">ဌာနအလိုက်ရှာရန်</button><a class="btn btn-primary " style="border: 10%" href="{{url('/profile/add')}}"    ><img src="{{ asset('storage/logos/Sign In.png') }}" alt="Logo"width="25" height="25">  ဝန်ထမ်းအသစ်ထဲ့ရန်  </a>
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
                            <tr>
                            <td>{{$profile->id}}</th>
                            <td>{{$profile->Name}}</th>
                            <td>{{$profile->Father_Name}}</th>
                            <td>{{$profile->NRC}}</th>
                            <td>{{$profile->DOB}}</th>
                            <td>{{$profile->educations->education}}</th>
                            <td>{{$profile->workingdeps->dep_name}}</th>
                            <td>{{$profile->positions->position_name}}</th>
                            <td>{{$profile->BASIC_SALARY}}</th>
                            <td>{{$profile->DEBT}}</th>
                         
                            <!--ဓါတ်ပုံ-->
                            <td  >
                                <img class="img-thumbnail mb-3" src="{{ asset('storage/staffimages/' . $profile->PHOTO_NAME) }}" alt="{{ $profile->PHOTO_NAME }}" width="100">
                            </td>
                            <!--STATUS ပြင်-->
                            <td  >@if($profile->STATUS==1)
                                <a href="{{url("/status/change/$profile->id")}}" class="btn btn-success btn-sm"  >ACTIVE</a>
                                 @elseif($profile->STATUS==0)
                                 <a href="{{url("/status/change/$profile->id")}}" class="btn btn-danger btn-sm"  >INACTIVE</a>    
                                 @endif
                            </td>
                            
                            <td><a href="{{url("/profile/edit/$profile->id")}}" class="btn btn-warning btn-sm"    >  EDIT </a></th>
                            <!-- delete button and confirm modal-->
                            <td><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$profile->id}}">
                                DELETE
                              </button>
                            
                            </td>
                            <td> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#StaffCardModal{{$profile->id}}"><img src="{{asset("storage/logos/cardnew.png")}}"  alt="Logo"width="25" height="25"></button></td>
                             <!--staff  card -->
                             <div class="modal fade" id="StaffCardModal{{$profile->id}}" tabindex="-1" aria-labelledby="StaffCardModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                            
                                  </div>
                                  <div class="staff-card">
                                    
                                      <img class="img-thumbnail mb-3 cycle-image" src="{{ asset('storage/staffimages/' . $profile->PHOTO_NAME) }}" alt="{{ $profile->PHOTO_NAME }}" width="100">
                                    
                                    
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" onclick="window.print()"><img src="{{asset("storage/logos/printer.png")}}"  alt="Logo"width="25" height="25"></a></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- delete  confirm modal-->
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