<?php


namespace App\Rules;


use Encore\Admin\Facades\Admin;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Cheack implements Rule
{
    public $class_id;
    public function __construct($id)
    {
        $this->class_id=$id;
    }
    public function passes($attribute, $value)
    {
        $records=  Db::table("classsection")->where("class_id",$this->id)->where($attribute,$value)->where("school_id",$this->school_id())->get()->count();
        if($records==0){
            return true;
        }
        else{
            return false;
        }
    }
    public function message()
    {

        return __('admission.duplicaterecored'.$this->table);
    }
    public function school_id(){
        return Admin::user()->school_id;
    }

}