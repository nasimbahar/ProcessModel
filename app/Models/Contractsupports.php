<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Contractsupports extends PhdModel
{
    use SoftDeletes;
    protected $table = 'contractsupports';
}
