<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packagess extends PhdModel
{

    protected $table = 'packages';
    public function clinicid()
    {
        return $this->belongsTo(Clinics::class, 'clinic_id');
    }
    public function packagetypeid()
    {
        return $this->belongsTo(PackagesTypes::class, 'package_type_id');
    }




}
