<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendencedetails extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'attendance_detials';
  
      public function employee(){
        return  $this->hasOne(Employee::class,'employee_id');
       // return $this->belongsTo(Employee::class, 'employee_id');
    
    }
}
