<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformConsenses extends PhdModel
{
    use SoftDeletes;
    protected $table = 'pconsensusmechanisms';
}
