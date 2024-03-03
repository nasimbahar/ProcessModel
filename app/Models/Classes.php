<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends PhdModel
{
    use SoftDeletes;
    protected $table = 'papertypes';
}
