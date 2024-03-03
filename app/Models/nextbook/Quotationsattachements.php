<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotationsattachements extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'quotation_attachments';
    
}



