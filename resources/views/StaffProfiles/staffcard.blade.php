@extends('layouts/app')
@section('content')
<style>
  .staff-card {
   
  border: 1px solid #ccc;
  border-radius: 5px;
  overflow: hidden;
  width: 250px;
   
  background-size: cover;
  background-position: center;
   
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.staff-card-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.7); /* Adjust the transparency here (0.0 to 1.0) */
  z-index: 1;
}

.staff-card-header {
  text-align: center;
  padding: 10px;
}
.staff-card-footer{
  text-align: :center;
  padding: 20px;
  font-weight:bold;

}
.staff-card-photo {
  border-radius: 25%;
  object-fit: cover;
  width: 120px; /* Set the desired width */
  height: 120px; /* Set the desired height */
  margin: 10px
}

.staff-card-body {
  padding: 10px;
  text-align: center;
}

.staff-card-name {
  margin-top: 0;
}

.staff-card-info {
  margin-bottom: 5px;

}
</style>
<div class="modal-body d-flex align-items-center justify-content-center">
    <div class="card mb-3" style="max-width: 18rem;">
      <div class="card-header">
        <!-- Header content if needed -->
      </div>
      <div class="card-body d-flex flex-column align-items-center justify-content-center">
        <div class="staff-card border-5 border-success">
          <div class="staff-card-header ">
            <img class="card-img-top img-fluid staff-card-photo border border-warning border-4" src="{{ asset('storage/staffimages/' . $forstaffcard->PHOTO_NAME) }}" alt="{{ $forstaffcard->PHOTO_NAME }}" style="width:75px;height:100px">
          </div>
          <div class="staff-card-body">
            <div class="border bg-success p-2 mt-2 rounded-pill text-white"><h5>{{$forstaffcard->Name}}</h5></div> 
            <div class="border border-success p-2 mt-2 rounded-pill"> ID - {{$forstaffcard->id}}</div> 
            <div class="border  border-success p-2 mt-2 rounded-pill"> ဌာန - {{$forstaffcard->workingdeps->dep_name}}</div> 
            <div class="border  border-success p-2 mt-2 rounded-pill">ရာထူး - {{$forstaffcard->positions->position_name}}</div> 
             
            
          </div>
          <div class="staff-card-footer">
            <img src="{{asset("storage/logos/MZTMlogo.jpg")}}"  alt="Logo"width="50" height="50"> MitzuTunMyint Co.,ltd  
          </div>
        </div>
          
        <!-- Additional content for the card body if needed -->
      </div>
      <div class="card-footer">
        <!-- Footer content if needed -->
        <button type="button" class="btn btn-outline-info" >Print</button>
        <button type="button" onclick="cancleform()" class="btn btn-outline-danger">Cancle</button>
      </div>
    </div>
  </div>
  <script>
    function cancleform(){
      window.location.href="/";
    }
  </script>
@endsection
