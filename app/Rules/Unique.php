<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
class Unique implements Rule
{
    public $table;
    public $value;
    public $another_column_value=0;
    public function __construct($table="years",$id=0)
    {   if($id!=0){
        $this->another_column_value=$id;
    }
        $this->table=$table;
    }
    public function passes($attribute,$value)
    {
        $functionaname=$this->table;
       return $this->$functionaname($attribute,$value);
    }
    public function message()
    {

        return __('admission.duplicaterecored'.$this->table);
    }
    public function school_id(){
        return Admin::user()->school_id;
    }

    private function years($attribute,$value){
        if($value=="on"){
            $value=1;
        }
        $records=  Db::table($this->table)->where($attribute,$value)->where("school_id",$this->school_id())->get()->count();
        if($records==0){
            return true;
        }
        else{
            if($value=="off"){
                return true;
            }

            return false;
        }
    }
    private function class_section($attribute,$value){
        $records=  Db::table("class_section")->where("class_id",$this->another_column_value)->where($attribute,$value)->where("school_id",$this->school_id())->get()->count();
        if($records==0){
            return true;
        }else {
            return false;
        }
    }
}
