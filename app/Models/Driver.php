<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends PhdModel
{
    use SoftDeletes;
    protected $table = 'driver';
}
