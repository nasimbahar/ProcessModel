<?php
namespace App\Models\nextbook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Units extends Nextbookmodel
{
     use SoftDeletes;
     protected $table = 'setting_unit_type';
      public static function dropdown()
    {
        return Units::all()->pluck('name', 'id');
    }
}
