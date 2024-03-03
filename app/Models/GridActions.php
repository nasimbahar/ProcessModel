<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class GridActions extends PhdModel
{

    protected $table = 'grid_actions';
    public function tablename(){
        return $this->belongsTo(AllTableSettings::class, 'setting_table_id');
    }
}
