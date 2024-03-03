<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projectstatus extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'project_status';
    
      public static function dropdown()
    {
        return Projectstatus::all()->pluck('name', 'id');
    }
   
    public static function getname($id){
        return Projectstatus::where('id',$id)->pluck('name');
    }
}


