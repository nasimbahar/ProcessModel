<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Tribe extends PhdModel
{
    use SoftDeletes;
    protected $table = 'tribes';

}
