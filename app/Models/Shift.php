<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends PhdModel
{
    use SoftDeletes;
    protected $table = 'shifts';
}
