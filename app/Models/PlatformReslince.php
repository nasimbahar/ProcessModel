<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformReslince extends PhdModel
{
    use SoftDeletes;
    protected $table = 'presiliencetypes';
}
