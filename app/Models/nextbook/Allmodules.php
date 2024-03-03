<?php


    namespace App\Models\nextbook;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Allmodules extends Nextbookmodel
    {
      
        protected $table = 'allmodules';
          public static function dropdown()
        {
            return Allmodules::all()->pluck('name', 'id');
        }
    }


