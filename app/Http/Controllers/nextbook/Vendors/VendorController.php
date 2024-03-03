<?php

namespace App\Http\Controllers\nextbook\Vendors;
use App\Models\nextbook\Vendor;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
class VendorController extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Vendor);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         $actions->disableView();
       });
        $grid->id('ID');
        $grid->name(__("vendor.vendorname"));
        $grid->phone(__("vendor.phone"));
        $grid->email(__("vendor.email"));
        $grid->webiste(__("vendor.website"));
        $this->title=__('vendor.customertitle');
        return $grid;
    }

    protected function form()
    {
       
        $form = new Form(new Vendor);
        $form->text("name",__("vendor.vendorname"))->rules("required");
        $form->text("company_name",__("vendor.company"));
        $form->mobile("phone",__("vendor.phone"));
        $form->email("email",__("vendor.email"));
        $form->url("website",__("vendor.website"));
        $form->textarea("address",__("vendor.address"));
        $form->textarea("note",__("vendor.note"));
        $form->hasMany("attachements",__("vendor.attachments"), function (Form\NestedForm $form) {
            $form->textarea("description",__("vendor.description"));
            $form->file("file",__("vendor.file"));
            $form->hidden("company_id")->default($this->companyid());
        });
        $form->hidden("company_id")->default($this->companyid());
        $form->hidden("user_id")->default($this->userid());
        return $form;
    }
   
}
