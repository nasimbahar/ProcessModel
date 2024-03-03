<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoicepayments extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'invoice_payments';
    
    public function user(){
         return $this->belongsTo(\App\User::class, 'user_id');
    }
    
}