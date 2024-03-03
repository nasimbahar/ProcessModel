<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendorattachments extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'vendor_attachments';
    
}


