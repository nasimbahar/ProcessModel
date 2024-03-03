<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class StudentFee extends PhdModel
{
    use SoftDeletes;
    protected $table = 'studentfee';
    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }
}
