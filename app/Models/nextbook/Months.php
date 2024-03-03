<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;

class Months extends Nextbookmodel
{
   
     protected $table = 'months';
       public static function dropdown()
    {
        return Months::all()->pluck('name', 'id');
    }
   
    
}