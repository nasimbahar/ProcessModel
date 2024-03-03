<?php

namespace App\Http\Controllers\nextbook\Projects;
use App\Models\nextbook\Projects;
use App\Models\nextbook\Projectstatus;
use App\Models\nextbook\Customers;
use App\Models\nextbook\Companycurrency;
use App\Models\nextbook\Projecttasks;
use Encore\Admin\Show;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Customviews\Teeth;
use App\Models\Dentalchart;
use Illuminate\Support\Facades\DB;
use Encore\LodpodEditor\LodpodEditorTemplate;


class ProjectController extends AdminController
{
   
     protected function grid()
    {
        $grid = new Grid(new Projects);
         if(Admin::user()->project_id==0){
        $grid->model()->where($this->wherecon());
         }
         else{
           $grid->model()->where('id',Admin::user()->project_id)->where($this->wherecon());  
         }
//         $grid->actions(function ($actions) {
//          $actions->disableView();
//        });
        $grid->id('ID');
        $grid->name('Name');
        $grid->customer()->name("Customer");
        $grid->projectstatus()->name("Project Status")->label([
        'Planned' => 'primary',
        'Ongoing' => 'success',
        'Completed' => 'default',
         'Pending' => 'warning',
        'Warranty Phase' => 'default',
        'Cancelled' => 'warning',
      ]);
           $grid->column('progress')->display(function ($progress, $column) {
           $allprojectprogresss= DB::Table('project_tasks')->where('project_id',$this->id)->sum('percentage');
           $allproject=DB::Table('project_tasks')->where('project_id',$this->id)->count();
           $avg=0;
           if($allproject!=0){
           $avg=$allprojectprogresss/$allproject;
           }
           
           return $column->progressBar($avg);
  
});
        $grid->start_date("start date");
        $grid->end_date("end date");
         
//        $grid->fname('Father Name');
//        $grid->contact_number('Mobile');
//        $grid->picture('Picture')->image('',50,50);
        return $grid;
    }

    
    protected function detail($id)
    {
        
         $tab = new \Encore\Admin\Widgets\Tab();
         $tab->add('Deliverables', \App\Helpers\nextbook\projects\DeliverablesTab::tab($id));
         $tab->add('Invioce and Payment', \App\Helpers\nextbook\projects\InvoiceTab::tab($id));
         $tab->add('Expenses', \App\Helpers\nextbook\projects\ExpensesTab::tab($id));
         $tab->add('Task and Progress', \App\Helpers\nextbook\projects\Taskstab::tab($id));
         $show = new Show(Projects::findOrFail($id));
         $show->panel()->istwocolumns('true');
         $show->name(__('project.name'))->istable("true");
         $show->project_status_id(__('project.projectstatus'))->as(function ($id) {
            return Projectstatus::getname($id);
        })->badge()->istable("true");
         $show->description(__("project.description"))->istable("true");
         $show->start_date(__("project.start_date"))->istable('true');
         $show->amount(__("project.amount"))->istable("true");
         $show->end_date(__("project.end_date"))->istable("true");
         $show->customer_id(__('project.projectcustomer'))->as(function ($id) {
            return Customers::getname($id);
        })->badge()->istable("true");
       $show->user_id(__('admin.username'))->as(function ($id) {
            return \App\User::getname($id);
        })->badge()->istable("true");
          $show->panel()
         ->tools(function ($tools) {
        $tools->append('<a class="btn btn-primary btn-sm btn-print" id="printtt" onclick="printpage()"><i class="fa fa-print"></i>print</a>');
     });
        
        return $show->render().$tab->render();
    }

    protected function form()
    {
      
        $form = new Form(new Projects);
        $form->setWidth(10, 6);
        
        $form->column(1/2, function ($form) {
        $form->text('name', __('project.projectname'))->rules('required|min:3');
        $form->select("project_status_id",__('project.projectstatus'))->options(Projectstatus::dropdown())->value(request('project_status_id'));
        $form->select("customer_id",__('project.projectcustomer'))->options(Customers::dropdown())->value(request('customer_id'));
        $form->text("amount",__('project.amount'))->readonly()->attribute("id","projectamount");
        });
          $form->column(1/2, function ($form) {
          $form->select("currency_id",__("project.currency"))->options(Companycurrency::dropdown())->value(request('currency_id'));
          $form->dateRange('start_date', 'end_date',__("project.daterange"));
          $form->hasMany("attachements",__("project.attachments"), function (Form\NestedForm $form) {
            $form->textarea("description",__("project.description"));
            $form->file("file",__("project.file"));
            $form->hidden("company_id")->default($this->companyid());
        });
        $form->hidden("company_id")->default($this->companyid());
        $form->hidden("user_id")->default($this->userid());
          });
          $form->column(12,function($form){
          $form->hasMany('deliverables',__('project.deliverables'), function (Form\NestedForm $form) {
          $form->text("deliverable",__('project.deliverables'));
          $form->number("price",__('project.price'));
          $form->select("unit_id",__("project.unit"))->options(\App\Models\nextbook\Companyunits::dropdown())->value(request('currency_id'));
          $form->number("quantity",__('project.quantity'));
          $form->text("amount",__('project.amount'))->readonly()->attribute("class","form-control rowamount");
          $form->hidden("user_id")->default($this->userid());
          $form->hidden("currency_id")->default(request("currency_id"));
           // $form->hidden("currency_id")->default(request("currency_id"));
          })->mode("table");
            
          });
         $form->textarea("description",__("project.description"));
         $form->textarea("note",__("project.note"));
         $form->html($this->javascript());


        return $form;
    }
    public function editt($id,$delverable){
        return "hello";
    }
    
    
    private function javascript(){
        $js="<script type='text/javascript'>
                                $(document).ready(function () {
                                    var id = 0;
                                    $(document).on('keyup', '.quantity,.price', function () {
                                      var quantity = $(this).closest('tr').find('input.quantity').val();
                                        var price = $(this).closest('tr').find('input.price').val();
                                        if (price != '' || quantity != '') {
                                            $(this).closest('tr').find('input.rowamount').val(price * quantity);
                                            var inputs = $('.rowamount');
                                            var sum = 0;
                                            inputs.each(function () {
                                              if(Number($(this).val())!=0){
                                                sum += Number($(this).val());
                                                }
                                            });
                                           
                                            $('#projectamount').val(sum);
                                        }
                                        else {
                                            $(this).closest('tr').find('input.amount').val('');
                                        }
                                    });
                                });
                            </script>";
        return $js;
                
    }
    
    public function newtask(Request $request){
      $project_id= $request->get('project_id');
      $start_date=$request->get('start_date');
      $due_date=$request->get('due_date');
      $task=$request->get('task');
      $percentage=$request->get('percentage');
      $projecttasks=new Projecttasks();
      $projecttasks->task=$task;
      $projecttasks->start_date=$start_date;
      $projecttasks->due_date=$due_date;
      $projecttasks->percentage=$percentage;
      $projecttasks->user_id=$this->userid();
      $projecttasks->project_id=$project_id;
      $projecttasks->save();

     return 1;
    }
    

    
    
   
}
