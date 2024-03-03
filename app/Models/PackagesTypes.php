<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackagesTypes extends PhdModel
{
    use SoftDeletes;
    protected $table = 'package_types';



}
