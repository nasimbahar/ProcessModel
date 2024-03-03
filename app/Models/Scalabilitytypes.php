<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Scalabilitytypes extends PhdModel
{
    use SoftDeletes;
    protected $table = 'scalabilitytypes';
}
