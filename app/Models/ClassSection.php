<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSection extends PhdModel
{
    use SoftDeletes;
    protected $table = 'class_section';
    public function classname(){
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function sectionname(){
        return $this->belongsTo(Section::class, 'section_id');
    }
}
