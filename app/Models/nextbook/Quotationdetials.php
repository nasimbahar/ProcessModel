<?php

namespace App\Models\nextbook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotationdetials extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'quotation_details';
    
     public function quotation()
    {
        return $this->belongsTo(Quotations::class,'quotation_id');
    }
   
}


