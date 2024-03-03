<?php


namespace App\Http\Controllers\Front;


use Encore\Admin\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

class AjaxController extends AdminController
{
  public function getdetials(){
      $tablename=request("table");
      $id=request("id");
     $string =Db::table($tablename)->where("id",$id)->get()->first()->definition;
     if($string!="" && $string!=null){
         return $string;
     }
     return "No details!";
  }
}
