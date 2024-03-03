<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;

 use Illuminate\Database\Eloquent\SoftDeletes;
class Employeeadditionalpayements extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'employee_additional_payments';
    
    public function employee(){
          
        return $this->belongsTo(Employee::class, 'employee_id');
    
    }
  public function type(){
          
        return $this->belongsTo(Employeeaditionalpayementstypes::class, 'type_id');
    
    }
    
    public function month(){
          
        return $this->belongsTo(Months::class, 'month_id');
    
    }
    
    
    
}
