<?php

namespace App\Models\nextbook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Nextbookmodel
{
   use SoftDeletes;

    protected $table = 'company';
    
    public static function companylogo(){
         $logtext= Company::where(Company::wherecon2())->get()->first()->logo;
         return "<img src='". admin_asset("uploads/".$logtext)."' width='130px' height='130px'>";
    }
    public  static function addresss(){
        return Company::where(Company::wherecon2())->get()->first()->address;
    }
     public  static function websitee(){
        return Company::where(Company::wherecon2())->get()->first()->website;
    }
     public  static function emaill(){
        return Company::where(Company::wherecon2())->get()->first()->email;
    }
     public  static function contactnumberr(){
        return Company::where(Company::wherecon2())->get()->first()->contactnumber;
    }
     public  static function name(){
         
        return Company::where(Company::wherecon2())->get()->first()->company_name;
    }
}


