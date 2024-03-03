<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformPrivacy extends PhdModel
{
    use SoftDeletes;
    protected $table = 'pprivacytypes';
}
