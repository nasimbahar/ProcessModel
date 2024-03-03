<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends PhdModel
{
    use SoftDeletes;
    protected $table = 'sections';
    public function yearname(){
        return $this->belongsTo(Year::class, 'year_id');
    }
    public function shiftname(){
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
