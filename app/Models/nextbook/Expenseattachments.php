<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenseattachments extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'expense_attachments';
    
}


