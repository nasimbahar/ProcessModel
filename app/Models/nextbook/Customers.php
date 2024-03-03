<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'customer';
 
      public static function dropdown()
    {
        return Customers::where(Customers::wherecon())->pluck('name', 'id');
    }
    
    public function attachements(){
          return $this->hasMany(Customerattachments::class, 'customer_id');
    }
    public static function getname($id){
         return Customers::where('id',$id)->pluck('name');
    }
}


