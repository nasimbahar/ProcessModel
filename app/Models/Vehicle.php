<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends PhdModel
{
    use SoftDeletes;
    protected $table = 'vehicle';
}
