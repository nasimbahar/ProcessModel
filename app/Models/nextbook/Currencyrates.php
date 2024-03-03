<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currencyrates extends Nextbookmodel
{
   use SoftDeletes;

    protected $table = 'currency_rates';
        public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }
}


