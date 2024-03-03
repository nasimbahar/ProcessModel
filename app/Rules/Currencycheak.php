<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
class Currencycheak implements Rule
{
    public $currency_id;
    public function __construct($currency_id)
    {
        $this->currency_id=$currency_id;
    }
    public function passes($attribute, $value)
    {
       $records=  Db::table("company_currency")->where(array("company_id"=>$this->companyid(),'deleted_at'=>null))->where("currency_type",$value)->get()->count();
        if($records==0){
            return true;
        }
        else{
            return false;
        }
    }
    public function message()
    {
        return __('settings.currencyerror');
    }
    public function companyid(){
         return Admin::user()->company_id;
    }
}
