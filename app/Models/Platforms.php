<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Platforms extends PhdModel
{
    use SoftDeletes;
    protected $table = 'platforms';

    public  function platformlanguages(){
        return $this->belongsToMany(Programminglanguages::class,'pprogramminglanguages',
            'platform_id','secondtable_id');
    }

    public  function platformresliance(){
        return $this->belongsToMany(Resiliencetypes::class,'presiliencetypes',
            'platform_id','secondtable_id');
    }
    public  function platformscalibilty(){
        return $this->belongsToMany(Scalabilitytypes::class,'pscalabilitytypes',
            'platform_id','secondtable_id');
    }
    public  function platformtokens(){
        return $this->belongsToMany(TokenTypes::class,'ptokenssupports',
            'platform_id','secondtable_id');
    }
    public  function platformlayers(){
        return $this->belongsToMany(Layersuppors::class,'playersupports',
            'platform_id','secondtable_id');
    }
    public  function platforminteropability(){
        return $this->belongsToMany(Interoperabilitytypes::class,'pinteroperabilitytypes',
            'platform_id','secondtable_id');
    }
    public  function platformconsense(){
        return $this->belongsToMany(ConsensusMechanisms::class,'pconsensusmechanisms',
            'platform_id','secondtable_id');
    }
    public  function platformprvaciy(){
        return $this->belongsToMany(PrivacyTypes::class,'pprivacytypes',
            'platform_id','secondtable_id');
    }
    public  function platformcontract(){
        return $this->belongsToMany(Contractsupports::class,'pcontractsupports',
            'platform_id','secondtable_id');
    }

}
