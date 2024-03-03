<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class TokenTypes extends PhdModel
{
    use SoftDeletes;
    protected $table = 'tokenssupports';
}
