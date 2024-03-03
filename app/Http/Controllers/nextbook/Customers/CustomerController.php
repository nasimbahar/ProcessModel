<?php

namespace App\Http\Controllers\nextbook\Customers;
use App\Models\nextbook\Customers;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
class CustomerController extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Customers);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         $actions->disableView();
       });
        $grid->id('ID');
        $grid->name(__("customer.customername"));
        $grid->phone(__("customer.phone"));
        $grid->email(__("customer.email"));
        $grid->webiste(__("customer.website"));
        $this->title=__('customer.customertitle');
        return $grid;
    }

    protected function form()
    {
       
        $form = new Form(new Customers);
        $form->text("name",__("customer.customername"))->rules("required");
        $form->text("company_name",__("customer.company"));
        $form->mobile("phone",__("customer.phone"));
        $form->email("email",__("customer.email"));
        $form->url("website",__("customer.website"));
        $form->textarea("address",__("customer.address"));
        $form->textarea("note",__("customer.note"));
        $form->hasMany("attachements",__("customer.attachments"), function (Form\NestedForm $form) {
            $form->textarea("description",__("customer.description"));
            $form->file("file",__("customer.file"));
            $form->hidden("company_id")->default($this->companyid());
        });
         $form->hidden("company_id")->default($this->companyid());
         $form->hidden("user_id")->default($this->userid());
        return $form;
    }
   
}
