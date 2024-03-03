<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'products';
  
      public static function dropdown()
    {
        return Products::where(Products::wherecon())->where("quantity",">",0)->pluck('name', 'id');
    }
    
    public function attachements(){
          return $this->hasMany(Employeeattachments::class, 'employee_id');
    }
    public function ishasproduct(){
                $item= Products::where(Products::wherecon())->where("quantity",">",0)->count();
                if($item>0){
                    return true;
                }
                else{
                    return false;
                }

    }
}


