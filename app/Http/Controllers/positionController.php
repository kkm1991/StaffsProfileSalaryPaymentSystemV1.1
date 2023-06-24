<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PositionList;

class positionController extends Controller
{
    public function add(){
        $addposition=new PositionList;
        $addposition->position_name=request()->positionname;
        $addposition->save();
        return redirect('/');
    }
}
