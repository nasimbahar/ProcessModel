<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Encore\Admin\Facades\Admin;

class Projects extends Nextbookmodel
{
    use SoftDeletes;
    protected $table = 'projects';
    
    public function deliverables()
    {
        return $this->hasMany(Projectdeliverables::class,'project_id');
    }
    public function projectstatus(){
          
        return $this->belongsTo(Projectstatus::class, 'project_status_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customers::class,'customer_id');
    }
    
     public function projecttasks()
    {
        return $this->hasMany(Projecttasks::class,'project_id');
    }
    
    public function attachements(){
       return $this->hasMany(Projectattachments::class, 'project_id');

    }
    public static function dropdown($isall=false){
        if(Admin::user()->project_id==0 || $isall){
           return Projects::where(Projects::wherecon())->pluck('name', 'id');
        }
        else{
           return Projects::where('id',Admin::user()->project_id)->where(Projects::wherecon())->pluck('name', 'id');  
        }

    }
     public static function getname($id){
         return Projects::where('id',$id)->pluck('name');
    }
}


