<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projectattachments extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'project_attachments';
    
}


