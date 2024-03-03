<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Resiliencetypes extends PhdModel
{
    use SoftDeletes;
    protected $table = 'resiliencetypes';

}
