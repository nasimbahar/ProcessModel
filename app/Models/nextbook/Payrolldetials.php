<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payrolldetials extends Nextbookmodel
{
    use SoftDeletes;

     protected $table = 'payrolls_details';
   
   
    
}