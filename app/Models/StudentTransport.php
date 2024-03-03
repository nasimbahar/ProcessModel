<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class StudentTransport extends PhdModel
{
    use SoftDeletes;
    protected $table = 'student_transport';
}
