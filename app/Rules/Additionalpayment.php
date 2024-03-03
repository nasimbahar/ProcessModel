<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
class Additionalpayment implements Rule
{
    public $month_id=0;
    
    public function __construct($month_id)
    {
        $this->month_id=$month_id;
        
    }
    public function passes($attribute, $value)
    {
       $records=  Db::table("payrolls")->where("company_id",$this->companyid())->where("year",$value)->where("month_id",$this->month_id)->get()->count();
        if($records==0){
            return false;
        }
        else{
            return false;
        }
    }
    public function message()
    {
        return __('employee.additionapaymenterror');
    }
    public function companyid(){
         return Admin::user()->company_id;
    }
}
