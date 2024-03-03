<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Programminglanguages extends PhdModel
{
    use SoftDeletes;
    protected $table = 'programminglanguages';
}
