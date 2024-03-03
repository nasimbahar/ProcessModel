<?php


    namespace App\Models\nextbook;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Workingdays extends Nextbookmodel
    {
        use SoftDeletes;
        protected $table = 'workingdays';
     
        public function month(){
          
        return $this->belongsTo(Months::class, 'month_id');
    
    }
    
    }


