<?php


namespace App\Http\Controllers\Master;

use App\Models\nextbook\Employee;
use App\Rules\Sectioncheack;
use App\Models\AllTableSettings;
use App\Models\PhdModel;
use App\Rules\Unique;
use Encore\Admin\Show;

class MasterHelper
{
    public $ClassName=null;
    public $grid=null;
    public $rules=null;
    public $fields=null;
    public $form=null;
    public $lang_file=null;
    public $uri=null;
    public $filters=null;
    public $footer=null;
    public $icon=null;
    public $submit_url=null;
    public $fieldWidth=6;
    public $labelWidth=2;
    public $firstRowMaxFields=5;
    public $secondRowMaxFields=10;
    public  $titles=null;
    public $relationship=null;
    public $callBack_function=null;
    public $is_extra_actions=null;
    public $options=null;
    public $view=null;
    public $gridWhere=null;
    public function getCleanUrl($uri){
        $Check=  strpos($uri, "?");
        if($Check!==false){
            $string= explode("?", $uri);
            $uri=$string[0];
        }
        $this->uri=$uri;
        $this->getTableSettings();
    }
    public function __construct()
    {
      //  $this->firstRowMaxFields=config("firstRowMaxFields",10);
        //$this->secondRowMaxFields=config("secondRow")
    }

    public function getTableSettings(){
        $record=AllTableSettings::where("name",$this->uri)->get()->first();
        $record->toArray();
        $this->grid = json_decode($record->grid,true);
        $this->form = json_decode($record->form,true);
        $this->fields = json_decode($record->fields,true);
        $this->lang_file = $record->lang_file;
        $this->rules = json_decode($record->rules,true);
        $this->ClassName=$record->model;
        $this->filters=json_decode($record->filters,true);
        $this->icon=json_decode($record->icon,true);
        $this->titles=json_decode($record->titles,true);
        $this->relationship=json_decode($record->relationship,true);
        $this->options=json_decode($record->options,true);
        $this->submit_url=json_decode($record->submit_url,true);
        $this->view=json_decode($record->view,true);
        $this->callBack_function=$record->callback_function;
        $this->is_extra_actions=$record->is_extra_action;
        $this->footer=json_decode($record->footer,true);
        $this->gridWhere=$record->gridwhere;
        $this->SetLayoutBasedOnFields();
    }

    public function SetLayoutBasedOnFields()
    {
        $size = sizeof($this->form);
        if($this->relationship!=null){
            $size=$size+1;
        }
        $result = intdiv($size, 2);
        $resultForThreeColumns = intdiv($size, 3);
        if ($size <= $this->firstRowMaxFields) {
            $this->firstRowMaxFields = $size;
            $this->fieldWidth = 6;
            $this->labelWidth = 2;
        } else if ($size <= $this->secondRowMaxFields) {
            $this->firstRowMaxFields = $result;
            $this->secondRowMaxFields = $result + $this->firstRowMaxFields;
            if ($result % 2 !== 0) {
                $this->firstRowMaxFields = $result + 1;
            }
            $this->fieldWidth = 10;
            $this->labelWidth = 6;
        } else {
            $this->firstRowMaxFields = $resultForThreeColumns;
            $this->secondRowMaxFields = $resultForThreeColumns + $this->firstRowMaxFields;
            if ($size % 3 == 2) {
                $this->firstRowMaxFields = $resultForThreeColumns + 1;
                $this->secondRowMaxFields = $resultForThreeColumns + $this->firstRowMaxFields + 1;
            }
            if ($size % 3 == 1) {
                $this->firstRowMaxFields = $resultForThreeColumns + 1;
                $this->secondRowMaxFields = $resultForThreeColumns + $this->firstRowMaxFields;
            }
            $this->fieldWidth = 10;
            $this->labelWidth = 12;
        }
    }
    public function getTitle($type,$id=0){

        if($this->titles!==null && $id!=0){
            if($type=="edit"){
                return $this->titles[2]." ".$this->ClassName::where("id",$id)->first()->name;
            }
          else  if($type=="create"){
                return $this->titles[1];
            }
          else  if($type=="grid"){
              return $this->titles[0];
          }
          else{
              return $this->titles[3]." ".$this->ClassName::where("id",$id)->first()->name;
          }
        }
    return "";
    }

    public function getColumnWidth(){
        $size =sizeof($this->form);
        if($size<=$this->firstRowMaxFields){
            return 12;
        }
        else if($size<=$this->secondRowMaxFields){
            return 6;
        }
        else{
            return 4;
        }
    }
    public function getIcon($fieldname){
        if($this->icon!==null){
            foreach($this->icon as $item){
                $Check=  strpos($item, ",");
                if($Check!==false){
                    $string= explode(",", $item);
                    $name=$string[0];
                    if($fieldname==$name){
                        return $string[1];
                    }
                }

            }
            return "fa-pencil";
        }
        return "fa-pencil";
    }
    public function getRule($fieldname){
        if($this->rules!==null){
            foreach($this->rules as $item){
                $Check=  strpos($item, ",");
                if($Check!==false){
                    $string= explode(",", $item);
                    $name=$string[0];
                    if($fieldname==$name){
                        if(strpos($string[1], "-")!==false){
                           return $this->getCustomeRule($string[1]);
                        }else {
                            return $string[1];
                        }
                    }
                }
            }
            return "";
        }
        return "";
    }
    public function getCustomeRule($rules){
        $array= explode("-", $rules);
        if(sizeof($array)==3){
            $classname = "App\Rules"."\\".$array[1];
            $tablename = $array[2];
            $finalruels=new $classname($tablename);

        }else {
            $builtinruels = $array[0];
            $classname = "App\Rules"."\\".$array[1];
            $tablename = $array[2];
            $parameter=request($array[3]);
            $finalruels=new $classname($tablename,$parameter);
        }
        return $finalruels;
    }
    public function callBackafterSubmitting($id,$isCreating,$isEditing){
         $obj=new Callback();
         if($this->callBack_function!==null) {
             $functionName = $this->callBack_function;
             $obj->$functionName($id, $isCreating, $isEditing);
         }
    }
    function endsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
    public function Additionalwhere(){
        $stringarray = explode(",", $this->gridWhere);
        $where=array();
        foreach($stringarray as $item){
            $keyvalue = explode("-", $item);
            $newarray=array($keyvalue[0]=>$keyvalue[1]);
            $where= array_merge($where,$newarray);
        }
        return $where;

    }


}
