<?php


namespace App\Http\Controllers\Master;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
public  function index($table){
    return DB::getSchemaBuilder()->getColumnListing($table);
}
public function getlang($table){
    $array=array();
    $index=0;
    $data=DB::getSchemaBuilder()->getColumnListing($table);
  $size=sizeof($data);
  for($index=0;$index<$size;$index++){
$exclude=array("id","school_id","updated_at","deleted_at","created_at","user_id");
if(in_array($data[$index],$exclude)){
    continue;
}
       $array=$array+array($data[$index]=>$data[$index]);



        
    }
return $array;

}
}