<?php

namespace App\Models\nextbook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capitalaccounts extends Nextbookmodel
{
   use SoftDeletes;

    protected $table = 'capital_accounts';
        public function currecny(){
          
        return $this->belongsTo(Currency::class, 'currency_id');
    }
     public static function dropdown()
    {
        return Capitalaccounts::where(Capitalaccounts::wherecon())->pluck('name', 'id');
    }
}


