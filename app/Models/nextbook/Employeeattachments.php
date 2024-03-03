<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeeattachments extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'employee_attachments';
    
}


