<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClass extends PhdModel
{
    use SoftDeletes;
    protected $table = 'student_class';
}
