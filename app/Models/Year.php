<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Year extends PhdModel
{
    use SoftDeletes;
    protected $table = 'years';
}
