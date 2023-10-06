@extends('layouts/app')
@section('content')
    <div class="container shadow bg-white  mb-5">
        <div class="row justify-content-center mb-5">
            <div class="col-11 text-center d-inline-block">
                <img class="m-3  " src="{{ asset('storage/logos/bsmlogo.png') }}" alt="Logo"width="150" height="130">
                <h1 class="text-center">မဉ္ဇူထွန်းမြင့် ကုမ္ပဏီလီမိတက်
                    </h1>
                    <h1 class="text-center">
                        MITZU TUN MYINT CO.,LTD</h1>
                <div class="text-center">
            No. 113, Mingyimaharminkhaung Street, Industrial Zone (4 ),Hlaingtharyar Township, Yangon.
            Phone: 01-685118 , 685736 Hp: 0951-72300 , 0950-16738
            </div>
            </div>
            <hr class="my-3">
        </div>
        <div class="row m-5 ">
            <div class=" "><img class="rounded shadow-lg" src="{{ asset('storage/staffimages/' . $profileDetail->PHOTO_NAME) }}"
                alt="{{ $profileDetail->PHOTO_NAME }}" width="125px " height="150px"></div>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                အမည်
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->Name }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                အဘအမည်
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->Father_Name }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                မှတ်ပုံတင်
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->NRC }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                မွေးသက္ကရာဇ်
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->DOB }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                ပညာအရည်အချင်း
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->educations->education }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                ဌာန
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->workingdeps->dep_name }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                ရာထူး
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->positions->position_name }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                အခြေခံလစာ
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->BASIC_SALARY }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                ချေးငွေ
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->DEBT }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                ဆက်သွယ်ရန်
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->ADDRESS }}
            </h4>
        </div>
        <div class="row m-5 ">
            <h4 class="col-5 text-start">
                အလုပ်ဝင်ရပ်စွဲ
            </h4>
            <h4 class="col-5 text-start">
                {{ $profileDetail->START_WORKING_DATE }}
            </h4>
        </div>
        <div class="row m-5  justify-content-end ">
            <img class="" src="{{asset('storage/logos/qrcode.png')}}" alt="" style="width: 150px; heigh:150px" >
        </div>

        <hr class="mb-5">
        <hr class="mb-5">
    </div>
@endsection
