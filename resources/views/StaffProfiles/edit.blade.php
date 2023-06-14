@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                Edit Staff Profile
                @if ($errors->any())
                    <div class="alert alert-warning">
                        <ol>
                            @foreach ($errors->all() as $error)
                           <li>
                            {{$error}}
                           </li>
                            @endforeach
                        </ol>
                        
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="staffname" class="form-control" value="{{$profiledata->Name}}">
                    </div>
                    <div class="mb-3">
                        <label for="">Father Name</label>
                        <input type="text" name="fathername" class="form-control" value="{{$profiledata->Father_Name}}">
                    </div>
                    <div class="mb-3">
                        <label for="">NRC</label>
                        <input type="text" name="nrc" class="form-control" value="{{$profiledata->NRC}}">
                    </div>
                    <div class="mb-3">
                        <label for="datepicker">Select Date of Birth:</label>
                        <input type="date" id="datepicker" name="datepicker" class="form-control" value="{{$profiledata->DOB}}">
                    </div>
                    <div class="mb-3">
                        <label for="">EDUCATION</label>
                        <select name="edcuation_list" id="" class="form-select">
                             
                            <option value="{{$profiledata->EDUCATION}}"selected>{{$profiledata->educations->education}}</option>
                            @foreach ($education as $educationlist)
                             <option value="{{$educationlist['id']}}">{{$educationlist['education']}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <label for="">WORKING DEPARTMENT</label>
                        <select name="working_dep_list" id="" class="form-select">
                            <option value="{{$profiledata->WORK_DEP}}"selected >{{$profiledata->workingdeps->dep_name}}</option>
                            @foreach ($deps as $dep)
                             <option value="{{$dep['id']}}">{{$dep['dep_name']}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <label for="">POSITION</label>
                        <select name="position_list" id="" class="form-select">
                            <option value="{{$profiledata->WORK_POSITION}}"selected >{{$profiledata->positions->position_name}}</option>
                            @foreach ($pos as $position)
                             <option value="{{$position['id']}}">{{$position['position_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">BASIC SALARY</label>
                        <input type="text" name="basic_salary" class="form-control"value="{{$profiledata->BASIC_SALARY}}">
                    </div>
                    <div class="mb-3">
                        <label for="">ADDRESS</label>
                        <input type="text" name="address" class="form-control"value="{{$profiledata->ADDRESS}}">
                    </div>
                    <div class="mb-3">
                        <label for="">Photo</label>
                        <input type="file" name="photo" class="form-control" id="photo">
                    </div>
                    <input type="submit" value="Save" class="btn btn-success"> <button type="button" class="btn btn-secondary" onclick="cancelForm()">Cancel</button> <br>
                </form>
                 <script>
                    function cancelForm(){
                        window.location.href="/";
                    }
                 </script>
            </div>
        </div>
    </div>
</div>
 
    
@endsection