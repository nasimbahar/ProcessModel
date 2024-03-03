<?php

namespace App\ExtraGridActions;


use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LinkGridAction extends RowAction
{
    public $name ;
    public $id;
    public $path="";
    function __construct($id=0,$url_label,$lang_file) {
        parent::__construct();
         $string = explode(",", $url_label);
         $this->path=$string[0]."/".$id."/".$string[1];
         $this->name=__($lang_file.".".$string[2]);
         $this->id=$id;


    }
    public function handle(Model $model, Request $request)
    {

    }
    public function href()
    {
        return admin_url($this->path);
    }
}