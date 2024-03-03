<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class ResignStudent extends PhdModel
{
    use SoftDeletes;
    protected $table = 'resigned_students';
    protected $fillable = ['student_id', 'school_id','user_id',"resign_date", "latter_no", "school_name", "reason", "remarks"] ;
    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }
}
