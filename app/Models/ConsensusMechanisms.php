<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class ConsensusMechanisms extends PhdModel
{
    use SoftDeletes;
    protected $table = 'consensusmechanisms';
}
