<?php

namespace App\Http\Controllers\nextbook\Settings;
use App\Models\nextbook\Employeepositions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
class EmployeepostionsController  extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Employeepositions);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         $actions->disableView();
       });
        $grid->id('ID');
        $grid->name(__('settings.postionname'));
        $this->title=__('settings.positontitle');
       
        return $grid;
    }

    

    protected function form()
    {
        $form = new Form(new Employeepositions);
        $form->text("name",__('settings.postionname'))->rules( ['required']);
        $form->hidden("company_id")->default($this->companyid());
        $form->hidden("user_id")->default($this->userid());
        return $form;
    }

    

   
    
    
    
    
   
}
