<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Layersuppors extends PhdModel
{
    use SoftDeletes;
    protected $table = 'layersupports';
}
