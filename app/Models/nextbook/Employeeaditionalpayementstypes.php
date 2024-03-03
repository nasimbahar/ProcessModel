<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;


class Employeeaditionalpayementstypes extends Nextbookmodel
{
  
    protected $table = 'employee_additional_payments_types';
 
      public static function dropdown()
    {
        return Employeeaditionalpayementstypes::all()->pluck('name', 'id');
    }
    
}


