<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expensepayments extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'expense_payments';
    
    public function user(){
         return $this->belongsTo(\App\User::class, 'user_id');
    }
    
}