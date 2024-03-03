<?php

namespace App\Http\Controllers\nextbook\Settings;
use App\Models\nextbook\Financialyear;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
class FinancialyearController  extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Financialyear);
       $grid->model()->where('company_id',$this->companyid());
       $grid->actions(function ($actions) {
         $actions->disableView();
         $actions->disableDelete();
       });
         $grid->id('ID');
         $grid->name(__("settings.yearname"));
         $grid->start_date(__('settings.start_date'));
         $grid->end_date(__('settings.end_date'));
        $grid->column(__("settings.iscompleted"))->display(function($column){
           if($this->iscompleted==1){
               return "Yes";
           }
           return "No";
       });
       getfinancilyear();
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Financialyear);
        $form->text("name",__("settings.yearname"))->rules("required");
        $form->dateRange("start_date", "end_date",__("settings.daterange"))->rules("required");
        $form->switch("iscompleted",__("settings.iscompleted"))->rules("required");
        $form->hidden("user_id")->default($this->userid());          
        $form->hidden("company_id")->default($this->companyid());
        return $form;
    }

  
    

 
    
    
    
    
   
}
