<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformScalibality extends PhdModel
{
    use SoftDeletes;
    protected $table = 'pscalabilitytypes';
}
