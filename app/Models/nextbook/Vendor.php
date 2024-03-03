<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'vendor';
      public function project()
    {
        $this->belongsTo(Projects::class);
    }
      public static function dropdown()
    {
        return Vendor::where(Vendor::wherecon())->pluck('name', 'id');
    }
    
    public function attachements(){
          return $this->hasMany(Vendorattachments::class, 'venodr_id');
    }
}


