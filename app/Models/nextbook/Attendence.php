<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendence extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'attendance';
    
    public function attendencedetaial(){
          return $this->hasMany(Attendencedetails::class, 'attendance_id');
    }
     public function month(){
          
        return $this->belongsTo(Months::class, 'month_id');
    
    }
    
}
