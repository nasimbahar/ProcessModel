<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'employee';
  
      public static function dropdown()
    {
        return Employee::where(Employee::wherecon())->pluck('name', 'id');
    }
    
    public function attachements(){
          return $this->hasMany(Employeeattachments::class, 'employee_id');
    }
}


