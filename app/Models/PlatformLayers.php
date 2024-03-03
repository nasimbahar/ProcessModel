<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformLayers extends PhdModel
{
    use SoftDeletes;
    protected $table = 'playersupports';
}
