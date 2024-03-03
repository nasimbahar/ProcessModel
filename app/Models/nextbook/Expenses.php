<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenses extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'expenses';
    
    public function expensedetials()
    {
        return $this->hasMany(Expensesdetials::class,'expense_id');
    }
      public function attachements(){
       return $this->hasMany(Expenseattachments::class, 'expense_id');

    }
     public function accountype(){
          
        return $this->belongsTo(Companycharts::class, 'company_chart_id');
    }
     public function project(){
          
        return $this->belongsTo(Projects::class, 'project_id');
    }
    
}