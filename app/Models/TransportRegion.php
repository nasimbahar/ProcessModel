<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class TransportRegion extends PhdModel
{
    use SoftDeletes;
    protected $table = 'transport_regions';
}
