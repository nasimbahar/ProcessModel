<?php


namespace App\Models;


use Encore\Admin\Grid\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllTableSettings extends PhdModel
{
    use SoftDeletes;
    protected $table = 'tables_settings';
}
