<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends PhdModel
{
    use SoftDeletes;
    protected $table = 'gender';
}
