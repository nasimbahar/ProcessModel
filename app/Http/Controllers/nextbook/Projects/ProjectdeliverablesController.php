<?php

namespace App\Http\Controllers\nextbook\Projects;
use App\Models\nextbook\Projects;
use App\Models\nextbook\Projectstatus;
use App\Models\nextbook\Customers;
use App\Models\nextbook\Companycurrency;
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


class ProjectdeliverablesController extends AdminController
{
   
     protected function grid($project_id)
    {
        
         $grid = new Grid(new \App\Models\nextbook\Projectdeliverables);
         $grid->model()->where("project_id",$project_id);
         $grid->actions(function ($actions) {
         $actions->disableView();
         });
        $grid->id('ID');
        $grid->deliverable('Name');
        return $grid->render();
    }

    
    protected function detail($id)
    {
        

        
         $tab = new \Encore\Admin\Widgets\Tab();
         $tab->add('Deliverables', \App\Helpers\nextbook\projects\DeliverablesTab::tab($id));
         $tab->add('Invioce and Payment', \App\Helpers\nextbook\projects\DeliverablesTab::tab($id));
         $tab->add('Expenses', \App\Helpers\nextbook\projects\DeliverablesTab::tab($id));
         $tab->add('Task and Progress', \App\Helpers\nextbook\projects\DeliverablesTab::tab($id));
  
        $show = new Show(Projects::findOrFail($id));
        $show->id('ID');
        $show->name('name'); 
        $show->panel()
      ->tools(function ($tools) {
        $tools->append('<a class="btn btn-primary btn-sm" id="print"><i class="fa fa-print"></i>print</a>');
     });
        
        return $show->render().$tab->render();
    }

    protected function form()
    {
      
          $form = new Form(new Projects);
          $form->setAction(admin_url("nextbook/projects/".$this->id));
          $form->setWidth(10, 6);
          $form->hidden("company_id")->default($this->companyid());
          $form->hidden("user_id")->default($this->userid());
          $form->hidden("project_id")->default($this->secondid);
          $form->column(12,function($form){
          $form->hasMany('deliverables',__('project.deliverables'), function (Form\NestedForm $form) {
          $form->text("deliverable",__('project.deliverables'));
          $form->number("price",__('project.price'));
          $form->select("unit_id",__("project.unit"))->options(\App\Models\nextbook\Companyunits::dropdown())->value(request('currency_id'));
          $form->number("quantity",__('project.quantity'));
          $form->text("amount",__('project.amount'))->readonly()->attribute("class","form-control rowamount");
          $form->number("delivered",__('project.delivered'));

          $form->hidden("user_id")->default($this->userid());
          $form->hidden("currency_id")->default(request("currency_id"));
          })->mode("table");
            
          });
    
         $form->html($this->javascript());


        return $form;
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
    
    
    
    
   
}
