<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class NativeLanguage extends PhdModel
{

    use SoftDeletes;
    protected $table = 'native_languages';
}
