<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoiceattachments extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'invoice_attachments';
    
}


