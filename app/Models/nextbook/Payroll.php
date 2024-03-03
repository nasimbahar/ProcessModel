<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Nextbookmodel
{
    use SoftDeletes;

     protected $table = 'payrolls';
   
    public function payrolldetailss(){
          return $this->hasMany(Payrolldetials::class, 'payroll_id');
    }
      public function month(){
          
        return $this->belongsTo(Months::class, 'month_id');
    
    }
}