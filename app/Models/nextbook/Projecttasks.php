<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projecttasks extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'project_tasks';

}


