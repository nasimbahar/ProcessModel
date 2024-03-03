<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformProglanguages extends PhdModel
{
    use SoftDeletes;
    protected $table = 'pprogramminglanguages';
}
