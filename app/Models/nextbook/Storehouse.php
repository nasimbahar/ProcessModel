<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storehouse extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'storehouse';
   public static function dropdown()
    {
        return Storehouse::where(Storehouse::wherecon())->pluck('name', 'id');
    }
   
}


