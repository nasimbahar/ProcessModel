<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Interoperabilitytypes extends PhdModel
{
    use SoftDeletes;
    protected $table = 'interoperabilitytypes';
}
