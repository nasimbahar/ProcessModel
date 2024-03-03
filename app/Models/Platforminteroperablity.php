<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Platforminteroperablity extends PhdModel
{
    use SoftDeletes;
    protected $table = 'pinteroperabilitytypes';
}
