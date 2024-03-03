<?php

namespace App\Http\Controllers\nextbook\Employee;
use App\Models\nextbook\Employee;
use App\Models\nextbook\Employeepositions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Show;
class EmployeeController extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Employee);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         //$actions->disableView();
       });
        $grid->id('ID');
        $grid->name(__("employee.employeename"));
        $grid->phone(__("employee.phone"));
        $grid->email(__("employee.email"));
        $this->title=__('employee.customertitle');
        return $grid;
    }
   protected function detail($id)
    {
      
        $show = new Show(Employee::findOrFail($id));
        $show->id('ID');
        $show->name('name'); 
        $show->fname('name'); 
        $show->identity_number('name'); 
        $show->phone('name'); 
        $show->address('name'); 
        return $show;
    }
    protected function form()
    {
       
        $form = new Form(new Employee);
        $form->text("name",__("employee.employeename"))->rules("required");
        $form->text("fname",__("employee.fathername"))->rules("required");
        $form->text("identity_number",__("employee.tazkiranumber"));
        $form->select("position_id",__("employee.postions"))->options(Employeepositions::dropdown());
        $form->mobile("phone",__("employee.phone"));
        $form->email("email",__("employee.email"));
        $form->radio("gender", __("employee.gender"))->options(['Male' => 'Male', 'Female'=> 'Female'])->default('Male');
        $form->textarea("address",__("employee.address"));
        $form->select("type",__("employee.type"))->options(array("Permanent"=>"Permanent","Temporary"=>"Temporary"));
        $form->text("salary",__("employee.salary"))->rules("required");
        $form->date("join_date",__("employee.joindate"))->rules("required");
        $form->switch("status","employee.status")->default(1);
        $form->select("blood",__("employee.blood"))->options(array("O-"=>"O-", "O+"=>"O+", "B-"=>"B-", "B+"=>"B+", "A-"=>"A-", "A+"=>"A+", "AB-"=>"AB-", "AB+"=>"AB+"));
        $form->select("project_id",__("employee.project_id"))->options(\App\Models\nextbook\Projects::dropdown())->value(request('project_id'));
        $form->image("photo",__("employee.photo"));
        $form->mobile("emergency",__("employee.emergency"));
        $form->textarea("location",__("employee.location"));
        $form->hasMany("attachements",__("employee.attachments"), function (Form\NestedForm $form) {
            $form->textarea("description",__("employee.description"));
            $form->file("file",__("employee.file"));
            $form->hidden("company_id")->default($this->companyid());
        });
        $form->hidden("company_id")->default($this->companyid());
        $form->hidden("user_id")->default($this->userid());
        return $form;
    }
   
}
