<?php

namespace App\Http\Controllers\nextbook\Settings;
use App\Models\nextbook\Units;
use App\Models\nextbook\Companyunits;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
class ComapanyunitsController  extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Companyunits);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         $actions->disableView();
       });
        $grid->id('ID');
        $grid->unit()->name(__('settings.unitname'));
        $this->title=__('settings.configreunits');
         if($this->isfirstlogin()){
                  $grid->footer(function ($query) {
                   $form=new \Encore\Admin\Widgets\Form1();
                    $form->disableSubmit();
                    $form->disableReset();
                    $html1="<a href=".admin_url('nextbook/companycurrency')."><button style='float:left' class='btn btn-info'>".__('admin.prev')."</button></a>";

                    $html="<a href=".admin_url('nextbook/chartofaccounts')."><button style='float:right' class='btn btn-info'>".__('admin.next')."</button></a>";
                    $form->html($html1.$html);
                  return $form->render();
             });
         }
        return $grid;
    }

    

    protected function form()
    {
        $form = new Form(new Companyunits);
        $form->select("unit_id",__('settings.unitname'))->options(Units::dropdown())->rules( ['required',new \App\Rules\Unique("company_unit_type")])->value(request('unit_id'));
        $form->hidden("company_id")->default($this->companyid());
        return $form;
    }

    

   
    
    
    
    
   
}
