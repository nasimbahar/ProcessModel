<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAttachments extends PhdModel
{
    use SoftDeletes;
    protected $table = 'student_attachments';
}
