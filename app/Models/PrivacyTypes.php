<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PrivacyTypes extends PhdModel
{
    use SoftDeletes;
    protected $table = 'privacytypes';
}
