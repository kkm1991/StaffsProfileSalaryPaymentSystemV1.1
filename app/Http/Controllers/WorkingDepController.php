<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkingDepList;

class WorkingDepController extends Controller
{
   public function add(){
    $adddep=new WorkingDepList;
    $adddep->dep_name=request()->depname;
    $adddep->save();
    return redirect('/');
   }
}
