<?php
namespace App\Models\nextbook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
class Companyunits extends Nextbookmodel
{
     use SoftDeletes;
     protected $table = 'company_unit_type';
         public function unit()
    {
        return $this->belongsTo(Units::class,'unit_id');
    }
         public static function dropdown()
    {
         return DB::table('setting_unit_type')
            ->join('company_unit_type', 'setting_unit_type.id', '=', 'company_unit_type.unit_id')
           ->where("company_unit_type.company_id",Admin::user()->company_id) ->pluck('setting_unit_type.name', 'setting_unit_type.id');
          ;
    }
}
