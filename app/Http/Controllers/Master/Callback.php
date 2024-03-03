<?php


namespace App\Http\Controllers\Master;


use App\Models\ClassSection;
use App\Models\Section;
use App\Models\Student;
use Encore\Admin\Facades\Admin;

class Callback
{

    public function studentClassId($id,$Iscreating,$IsEditing){
        $record= Student::where('id',$id)->get()->first();
        $class_id=$record->class_id;
        $section_id=$record->section_id;
        $class_section_id=ClassSection::where(array("class_id"=>$class_id,"section_id"=>$section_id))->first()->id;
        $year_id=Section::where("id",$section_id)->get()->first()->year_id;
        if($Iscreating){
            $student_class_id = DB::table('students_class')->insertGetId(
                ['school_id' => Admin::user()->school_id, 'student_id' => $id,"class_section_id"=>$class_section_id,
                    "year_id"=>$year_id,"user_id"=>Admin::user()->id,"is_current"=>1]
            );
            DB::table('students')
                ->where('id', $id)
                ->update(['student_class_id' => $student_class_id]);
        }
        if($IsEditing){
            DB::table('students_class')
                ->where(array('student_id'=>$id,"is_current"=>1))
                ->update(['class_section_id' => $class_section_id]);
        }

    }
}