<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationList;

class educationController extends Controller
{
  public function add(){
    $addedu=new EducationList;
    $addedu->education=request()->eduname;
    $addedu->save();
    return redirect('/');
  }
}
