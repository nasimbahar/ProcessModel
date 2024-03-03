<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Transportfee extends PhdModel
{
    use SoftDeletes;
    protected $table = 'transport_fee';
}
