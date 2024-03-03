<?php

namespace App\Helpers\nextbook\projects;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use App\Models\nextbook\Projecttasks;
use Encore\Admin\Grid;
use App\ExtraGridActions\nextbook\Delerables;
use Encore\Admin\Facades\Admin;


class Taskstab
{
    public static $project_id;

    /**
     * Build a form here.
     */
    public static function tab($project_id)
    {
          DeliverablesTab::$project_id=$project_id;
         $grid = new Grid(new \App\Models\nextbook\Projecttasks);
         $grid->model()->where("project_id",$project_id);
        $grid->actions(function ($actions) {
         $actions->disableView();
           $actions->disableEdit();
           $actions->disableDelete();
            $actions->add(new \App\ExtraGridActions\nextbook\Tasks($actions->getkey()));
    
                
                           
                        
         
         });
        $grid->disableCreateButton();
         $grid->disableCreateButton();
        $grid->tools(function ($tools) {
        $tools->append("<a href='#' class='btn btn-sm btn-primary' data-toggle='modal' data-target='#modal-default' style='float:right'>Create</a>".'<div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">New task</h4>
              </div>
              <div class="modal-body">'.Taskstab::formnewtask().'</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savedata">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>'.Taskstab::Javscript());
});
       
        $grid->id('ID');
        $grid->task(__("project.task"));
     
        $grid->start_date(__("project.start_date"));
        $grid->due_date(__("project.due_date"));
        $grid->column('progress')->display(function ($progress, $column) {
            return $column->progressBar($this->percentage);
        });
   
        $grid->footer(function ($query) {
       $allpercentagesum= $query->where('project_id', DeliverablesTab::$project_id)->sum('percentage');
       $allrecords= $query->where('project_id', DeliverablesTab::$project_id)->count();
   if($allrecords!=0){
   $percenatge=$allpercentagesum/$allrecords;
   }
   else{
       $percenatge=0;
   }

    return "<div style='padding: 10px;'>Total Percentage ：". $percenatge." %</div>";
});

        return $grid->render();
       
        
        
    }
    
    public static function formnewtask(){
        
      $form = new Form(new Projecttasks);
         $form->setWidth(6);

        $form->textarea("task",__('project.task'))->attribute('id','task');

        $form->date("start_date",__("project.start_date"))->attribute('id','start_date');
        $form->date("due_date",__("project.due_date"))->attribute('id','due_date');
       $form->text("percentage",__('project.percentage'))->attribute('id','percentage');
       $form->hidden('project_id')->attribute('id','project_id')->default(DeliverablesTab::$project_id);
       
        $form->disableReset();
        $form->disableSubmit();
 
            return $form->render();
                
    }
    
    public static function Javscript(){
        
    $javascript="<script>
	
     
     
	    $(function(){
$('#savedata').click(function(){


       var start_date=$('#start_date').val();
       var due_date=$('#due_date').val();
       var task=$('#task').val();
       var percentage=$('#percentage').val();
       var project_id=$('#project_id').val();
            $.ajax({
    url: '". admin_url('nextbook/newtask')."',
    method: 'get',  
    data:{'start_date':start_date,'due_date':due_date,'task':task,'percentage':percentage,'project_id':project_id},
    success: function(data){
       $('#modal-default').modal('hide');
      
       location.reload();
    }
});
});
 });



                


		</script>";
        return $javascript;
    }
   
}
