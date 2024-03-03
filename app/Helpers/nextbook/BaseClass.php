<?php

namespace App\Helpers\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Encore\Admin\Facades\Admin;

class BaseClass extends Model
{
    //var $where=array("company_id"=>1);
    protected static  function wherecon(){
        
        return array('company_id'=>Admin::user()->company_id);
    }
    protected static  function wherecon2(){
        
        return array('id'=>Admin::user()->company_id);
    }
}