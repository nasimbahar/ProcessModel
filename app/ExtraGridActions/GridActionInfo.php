<?php

namespace App\ExtraGridActions;


use App\Models\AllTableSettings;
use App\Models\GridActions;

class GridActionInfo
{
public $setting_table_id=null;
public $form=null;
public $fields=null;
public $rules=null;
public $type=null;
public $url=null;
public $call_back_function;
public $class_name;


public function getGridInfo($uri){
    $id=AllTableSettings::where("name",$uri)->get()->first()->id;
  return  GridActions::where('setting_table_id',$id)->get();

}

}