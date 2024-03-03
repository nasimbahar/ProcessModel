<?php

namespace App\ExtraGridActions\nextbook;


use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\nextbook\Expenses;
use App\Models\nextbook\Expensepayments;
use Encore\Admin\Facades\Admin;
 use Illuminate\Http\Request;

class Delerables extends RowAction
{
    public $name ;
    public $id;
    function __construct($id=0) {
        parent::__construct();
        $this->name=__("admin.edit");
        $this->id=$id;
    }

    public function handle(Model $model, Request $request)
    {
       $id=$request->get('id');
       $delivered=$request->get("delivered");
       \Illuminate\Support\Facades\DB::table("project_deliverables")->where("id",$id)->update(array("delivered"=>$delivered));
       
        return $this->response()->success('Success message.')->refresh();
    }
 public function form()
{
    if($this->id!=0){
    $record=  \Illuminate\Support\Facades\DB::table("project_deliverables")->where("id",$this->id)->first();
    $this->hidden("id")->default($this->id);
    $this->text("deliverables",__("project.deliverables"))->default($record->deliverable)->readonly();
    $this->text("delivered",__("project.delivered"))->default($record->delivered);
    $this->text("quantity",__("project.quantity"))->default($record->quantity)->readonly();


    }
}
}