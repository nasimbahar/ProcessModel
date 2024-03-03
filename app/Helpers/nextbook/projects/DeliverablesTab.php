<?php

namespace App\Helpers\nextbook\projects;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Encore\Admin\Grid;
use App\ExtraGridActions\nextbook\Delerables;

class DeliverablesTab 
{
    public static $project_id;

    /**
     * Build a form here.
     */
    public static function tab($project_id)
    {
          DeliverablesTab::$project_id=$project_id;
         $grid = new Grid(new \App\Models\nextbook\Projectdeliverables);
         
         $grid->model()->where("project_id",$project_id);
         $grid->actions(function ($actions) {
         $actions->disableView();
           $actions->disableEdit();
           $actions->disableDelete();
            $actions->add(new Delerables($actions->getkey()));
    
                
                           
                        
         
         });
        $grid->disableCreateButton();
        $grid->id('ID');
        $grid->deliverable('Name');
        $grid->quantity(__("project.quantity"));
        $grid->price(__("project.price"));
        $grid->column('progress')->display(function ($progress, $column) {
            return $column->progressBar($this->delivered*100/$this->quantity);
        });
        $grid->delivered(__("project.delivered"));
          $grid->column(__("project.deliveredamount"))->display(function ($progress, $column) {
           
           
           return $this->price*$this->delivered;
  
});
        $grid->footer(function ($query) {
       $allprojectamount= \Illuminate\Support\Facades\DB::table("projects")->where('id',DeliverablesTab::$project_id)->first()->amount;
       $amount= $query->where('project_id', DeliverablesTab::$project_id)->get();
       $delveraamount=0;
   foreach($amount as $item){
       $delveraamount+=$item->price*$item->delivered;
   }
   $percenatge=100*$delveraamount/$allprojectamount;

    return table_footer(__("project.percentage"), round($percenatge)."%").table_footer(__("project.amount"), round($allprojectamount)).table_footer(__("project.delivered"), round($delveraamount));
});

        return $grid->render();
       
        
        
    }

   
}
