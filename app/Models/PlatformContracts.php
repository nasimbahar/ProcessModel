<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformContracts extends PhdModel
{
    use SoftDeletes;
    protected $table = 'pcontractsupports';
}
