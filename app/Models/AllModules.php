<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class AllModules extends PhdModel
{
    use SoftDeletes;
    protected $table = 'allmodules';
}
