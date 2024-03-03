<?php

namespace App\Http\Controllers\nextbook\Settings;
use App\Models\nextbook\Workingdays;
use App\Models\nextbook\Months;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
class WorkingdaysController  extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Workingdays);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         $actions->disableView();
       });
        $grid->id('ID');
        $grid->month()->name(__('settings.month_id'));
        $grid->year(__('settings.year'));
        $grid->working_days(__('settings.working_days'));

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Workingdays);
        $form->select("year",__("settings.year"))->options(array(date("Y")=>date("Y"),date("Y")-1=>date("Y")-1))->rules( ['required',new \App\Rules\WorkingdaysCheack(request('month_id'))])->value(request('currency_id'));
        $form->select("month_id",__("settings.month_id"))->options(Months::dropdown())->rules("required");
        $form->text("working_days",__("settings.working_days"))->icon("fa-calendar-plus-o")->rules("required");
        $form->hidden("company_id")->default($this->companyid());
        $form->hidden("user_id")->default($this->userid());
        return $form;
    }

 

 
    
    
    
    
   
}
