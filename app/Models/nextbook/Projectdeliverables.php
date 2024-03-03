<?php

namespace App\Models\nextbook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projectdeliverables extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'project_deliverables';
    
     public function project()
    {
        return $this->belongsTo(Projects::class,'project_id');
    }
   
}


