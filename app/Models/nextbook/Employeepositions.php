<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeepositions extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'employee_positions';
 
      public static function dropdown()
    {
        return Employeepositions::where(Employeepositions::wherecon())->pluck('name', 'id');
    }
    
   
}


