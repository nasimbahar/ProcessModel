<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balancesheet extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'balance_sheet';
    
       public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }
         public function accountype(){
          
        return $this->belongsTo(Companycharts::class, 'account_id');
    }
}