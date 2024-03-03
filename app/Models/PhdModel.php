<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\DB;

class PhdModel extends Model
{
    public static function dropdown($table_name)
    {

              return DB::table($table_name)->pluck('name', 'id');



    }

    public static function getName($table_name,$id){
        if($id!==null) {
            $record=DB::table($table_name)->where("id", $id)->get()->first();
            if($record!==null){
                return $record->name;
            }
            return "";
        }
        else
            return "";

    }




}
