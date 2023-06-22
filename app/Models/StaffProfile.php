<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffProfile extends Model
{
    use HasFactory;
    public function positions(){
        return $this->belongsTo('App\Models\PositionList','WORK_POSITION');
         
    }
    public function workingdeps(){
        return $this->belongsTo('App\Models\WorkingDepList','WORK_DEP' );
          
    }
    
    public function educations(){
        return $this->belongsTo('App\Models\EducationList','EDUCATION' );
    }
    public function reservation(){
        return $this->hasMany('App\Models\reservation','id');
    }
}
