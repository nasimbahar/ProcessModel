<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class District extends PhdModel
{
    use SoftDeletes;
    protected $table = 'district';
    public static function province(){
        return (new District)->belongsTo(Province::class, 'province_id');
    }
}
