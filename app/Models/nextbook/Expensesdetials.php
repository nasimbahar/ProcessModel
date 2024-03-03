<?php

namespace App\Models\nextbook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expensesdetials extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'expense_detials';
    
     public function expense()
    {
        return $this->belongsTo(Expenses::class,'expense_id');
    }
    public function project(){
          
        return $this->belongsTo(Projects::class, 'project_id');
    }
    public function chartofaccount(){
        return $this->belongsTo(Companycharts::class,'company_chart_id');
    }
}


