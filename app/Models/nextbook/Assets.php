<?php


    namespace App\Models\nextbook;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Assets extends Nextbookmodel
    {
       use SoftDeletes;

        protected $table = 'assets';
         public function accountype(){
          
        return $this->belongsTo(Companycharts::class, 'asset_type_id');
    }
       
    }


