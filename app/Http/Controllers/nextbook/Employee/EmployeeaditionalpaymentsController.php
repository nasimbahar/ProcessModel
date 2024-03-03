<?php

namespace App\Http\Controllers\nextbook\Employee;
use App\Models\nextbook\Employee;
use App\Models\nextbook\Employeeadditionalpayements;
use App\Models\nextbook\Months;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Show;
class EmployeeaditionalpaymentsController extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Employeeadditionalpayements);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         //$actions->disableView();
       });
        $grid->filter(function($filter){
        $filter->like('name', __("employee.employeename"));
        $filter->like('year', __("employee.year"));
        $filter->equal('month_id',__("employee.month_id"))->select(\App\Models\nextbook\Months::dropdown());
        $filter->equal('type_id',__("employee.type_id"))->select(\App\Models\nextbook\Employeeaditionalpayementstypes::dropdown());

});
        $grid->id('ID');
        $grid->employee()->name(__("employee.employeename"));
        $grid->type()->name(__("employee.type_id"));
        $grid->month()->name(__("employee.month_id"));
        $grid->year(__("employee.year"));
        $grid->amount(__("employee.amount"));
        return $grid;
    }
   protected function detail($id)
    {
       return 1;
      
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
       
         $Javascript=new \App\Helpers\nextbook\employee\EmployeeInfo();
         $form = new Form(new Employeeadditionalpayements);
         $form->select('employee_id',__("employee.employeename"))->options(function ($id) {
         $employee = \App\Models\nextbook\Employee::find($id);
        if ($employee) {
         return [$employee->id => $employee->name];
        }
       })->rules('required')->ajax(admin_url("api/employee"))->attribute(['id'=>'employee_id','onchange'=>'changeselect()']);
         $form->html("<div id='info'></div>".$Javascript->loadEmployeeinformation());
         $form->select("type_id",__("employee.type_id"))->options(\App\Models\nextbook\Employeeaditionalpayementstypes::dropdown())->rules("required");
         $form->select("year",__("employee.year"))->options(array(date("Y")=>date("Y"),date("Y")-1=>date("Y")-1))->rules(['required',new \App\Rules\Additionalpayment(request('month_id'))]);
         $form->select("month_id",__("employee.month_id"))->options(Months::dropdown())->rules("required");
         $form->date("date","Date")->rules("required")->rules("required");
         $form->text("amount",__("employee.amount"))->icon("fa fa-money")->rules("required");
         $form->textarea("note","Note");
         $form->hidden("company_id")->default($this->companyid());
         $form->hidden("user_id")->default($this->userid());
         $form->saving(function (Form $form){
            $form->company_id=$this->companyid();
            $form->user_id=$this->userid();
        });
         $form->tools(function (Form\Tools $tools) {
         $tools->disableView();
         });
        return $form;
    }
   
}
