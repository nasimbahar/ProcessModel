<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Financialyear extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'financial_year';
    

}