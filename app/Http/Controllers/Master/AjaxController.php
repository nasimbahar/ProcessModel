<?php


namespace App\Http\Controllers\Master;


use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController
{
    public $childCasCadingID=null;
   public function casecadingfield(Request $request){
       $id = $request->get('q');
       $path=$request->url();
       if( $Check = strpos($path, "-")){

       }
       else{
       $table_name=$this->getTableName($path);
       return Db::table($table_name)->where($this->getForignKeyForCasecading($table_name), $id)->get(['id', DB::raw('name as text')]);
   }}
   public function classsection(Request $request){
       $id = $request->get('q');
  return     DB::table('sections')
          ->join('years','years.id','=','sections.year_id')
           ->join('class_section','class_section.section_id','=','sections.id')
           ->where(['class_id' => $id,"years.is_current"=>1])
           ->get(['sections.id as id', DB::raw('sections.name as text')]);
   }

   private function getForignKeyForCasecading($table){
       switch ($table){
           case "district":
               return "province_id";
               break;


       }
   }
    function getTableName($path)
    {

        return substr($path, strrpos($path, '/') + 1);
    }
    function IsCaseadingFiledNotNull($id,$className,$coulmn_name){
       if($id!=0) {
           $record = $className::where("id", $id)->first()->$coulmn_name;
           if ($record != null && $record > 0) {
               $this->childCasCadingID = $record;
               return true;
           }
       }
       return false;
    }
    function SelectedOptionOfCasecading($tablename,$id){
     $name=  Db::table($tablename)->where("id",$id)->first()->name;
     $options=array($id=>$name);
     return $options;
    }
    function CascadingID($id,$className,$coulmn_name){
        return $className::where("id",$id)->first()->$coulmn_name;


    }



}