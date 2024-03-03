<?php


namespace App\ExtraGridActions;


use App\Models\Student;
use Illuminate\Support\Facades\DB;

class GridCallBackfunction
{
public  function updateisresgin($id){
    DB::table('students')
        ->where('id', $id)
        ->update(['is_resign' => 1]);
}
}