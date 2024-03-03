<?php
namespace App\Models\nextbook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Nextbookmodel
{
     use SoftDeletes;
     protected $table = 'setting_currency_type';
      public static function dropdown()
    {
        return Currency::all()->pluck('currency_name', 'id');
    }
     public static function getname($id){
         return Currency::where('id',$id)->pluck('currency_name');
    }
}
