<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotations extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'quotations';
    
    public function quotationsdetials()
    {
        return $this->hasMany(Quotationdetials::class,'quotation_id');
    }
    public function product(){
          
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customers::class,'customer_id');
    }
    
    public function attachements(){
       return $this->hasMany(Quotationsattachements::class, 'quotation_id');

    }
   
}


