<?php


namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends PhdModel
{
    use SoftDeletes;
    protected $table = 'students';

    public function attachments(){
        return $this->hasMany(StudentAttachments::class, 'student_id');
    }
    public function studentclass(){
        return $this->hasMany(StudentClass::class, 'student_id');
    }
    public function gender(){
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function address(){
        return $this->hasMany(Address::class, 'student_id');
    }
    public function classname(){
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function sectionname(){
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function graduatedyear(){
        return $this->belongsTo(Year::class, 'graduated_year_id');
    }

}
