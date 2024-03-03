<?php


namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companycharts extends Nextbookmodel
{
   use SoftDeletes;

    protected $table = 'company_charts';
   public function accountype(){
          
        return $this->belongsTo(Accounttypes::class, 'account_type_id');
    }
    public static function companyexpenseaccount($currecny_id=3){
         return Companycharts::where(Companycharts::wherecon())->orWhere('company_id',0)->where(array("account_type_id"=>4,'currency_id'=>$currecny_id))->pluck('name', 'id');
    }
     public static function companyassetsaccount($currecny_id=3){
                return Companycharts::where(Companycharts::wherecon())->orWhere('company_id',0)->where(array("account_type_id"=>1,'currency_id'=>$currecny_id))->where('name', 'like', '%Equipment%')->pluck('name', 'id');
    }
     public static function companyinventoryaccount($currecny_id=3){
                return Companycharts::where(Companycharts::wherecon())->orWhere('company_id',0)->where(array("account_type_id"=>1,'currency_id'=>$currecny_id))->where('name', 'like', '%Inventory%')->pluck('name', 'id');
    }
    
     public static function companyrevenueaccounts($currecny_id=3){
         return Companycharts::where(Companycharts::wherecon())->orWhere('company_id',0)->where(array("account_type_id"=>3,'currency_id'=>$currecny_id))->pluck('name', 'id');
    }
      public static function dropdown()
    {
                 return Companycharts::where(Companycharts::wherecon())->orWhere('company_id',0)->pluck('name', 'id');

    }
         public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }
    
    public static function cashaccounts($currecny_id=3){
        
                return Companycharts::where(Companycharts::wherecon())->orWhere('company_id',0)->where(array("account_type_id"=>1,'currency_id'=>$currecny_id))->where('name', 'like', '%Cash%')->pluck('name', 'id');
 
    }
}


