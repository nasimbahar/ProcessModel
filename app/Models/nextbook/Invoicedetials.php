<?php

namespace App\Models\nextbook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoicedetials extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'invoice_details';
    
     public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
   
}


