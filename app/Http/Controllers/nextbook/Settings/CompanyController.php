<?php

namespace App\Http\Controllers\nextbook\Settings;
use App\Models\nextbook\Company;
use App\Models\nextbook\Accounttypes;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
class CompanyController  extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Company);
       $grid->model()->where('id',$this->companyid());
       $grid->actions(function ($actions) {
         $actions->disableView();
         $actions->disableDelete();
       });
     $grid->disableCreateButton();
        $grid->id('ID');
         $grid->company_name(__('company.company_name'));
        $grid->username(__('company.username'));
         $grid->logo(__("company.logo"))->image('',50,50);
       
       
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Company);
        $form->text("company_name",__('company.company_name'))->rules('required');
        $form->text("username",__('company.username'));
        $form->url("website",__('company.website'));
         $form->email("email",__('company.email'));
         $form->text("contactnumber",__('company.contactnumber'));
         $form->textarea("address",__('company.address'));
       $form->image("logo",__("company.logo"));
        return $form;
    }

  
    

 
    
    
    
    
   
}
