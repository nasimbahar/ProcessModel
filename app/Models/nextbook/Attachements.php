<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachements extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'attachements';
   
}


