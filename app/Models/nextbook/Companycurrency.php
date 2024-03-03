<?php


namespace App\Models\nextbook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;



class Companycurrency extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'company_currency';
        public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }
      public static function dropdown()
    {
         return DB::table('setting_currency_type')
            ->join('company_currency', 'setting_currency_type.id', '=', 'company_currency.currency_id')
           ->where(array("company_currency.company_id"=>Admin::user()->company_id,'company_currency.deleted_at'=>null)) ->pluck('setting_currency_type.currency_name', 'setting_currency_type.id');
          ;
    }
}


