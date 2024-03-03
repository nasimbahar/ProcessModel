<?php


    namespace App\Models\nextbook;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Accounttypes extends Nextbookmodel
    {
       use SoftDeletes;

        protected $table = 'account_types';
          public static function dropdown()
        {
            return Accounttypes::all()->pluck('name', 'id');
        }
    }


