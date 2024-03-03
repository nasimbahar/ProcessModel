<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Allpapers extends PhdModel
{
    use SoftDeletes;
    protected $table = 'allpapers';
    public function type(){
        return $this->belongsTo(PaperTypes::class, 'type_id');
    }
    public function year(){
        return $this->belongsTo(Year::class, 'year_id');
    }
}
