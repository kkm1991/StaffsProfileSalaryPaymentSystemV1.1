<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDepList extends Model
{
    use HasFactory;
    public function staffbydep(){
        return $this->hasMany('App\Models\StaffProfile','id');
      }
       
}
