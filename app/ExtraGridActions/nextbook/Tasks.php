<?php

namespace App\ExtraGridActions\nextbook;


use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\nextbook\Expenses;
use App\Models\nextbook\Expensepayments;
use Encore\Admin\Facades\Admin;
 use Illuminate\Http\Request;

class Tasks extends RowAction
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
      $start_date=$request->get('start_date');
      $due_date=$request->get('due_date');
      $task=$request->get('task');
      $percentage=$request->get('percentage');
       \Illuminate\Support\Facades\DB::table("project_tasks")->where("id",$id)->update(array("start_date"=>$start_date,'due_date'=>$due_date,'task'=>$task,'percentage'=>$percentage));
       
        return $this->response()->success('Success message.')->refresh();
    }
 public function form()
{
    if($this->id!=0){
    $record=  \Illuminate\Support\Facades\DB::table("project_tasks")->where("id",$this->id)->first();
    $this->hidden("id")->default($this->id);
    $this->text("task",__("project.task"))->default($record->task);
    $this->date("start_date",__("project.start_date"))->default($record->start_date);
    $this->date("due_date",__("project.due_date"))->default($record->due_date);
    $this->text("percentage",__("project.percentage"))->default($record->percentage);

    }
}
}