<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends PhdModel
{
    use SoftDeletes;
    protected $table = 'address';
}
