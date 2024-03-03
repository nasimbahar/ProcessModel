<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
        protected $table = 'admin_users';
        
         public static function getname($id){
         return User::where('id',$id)->pluck('name');
    }

}
