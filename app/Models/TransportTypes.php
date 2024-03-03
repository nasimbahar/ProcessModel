<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class TransportTypes extends PhdModel
{
    use SoftDeletes;
    protected $table = 'transport_types';
}
