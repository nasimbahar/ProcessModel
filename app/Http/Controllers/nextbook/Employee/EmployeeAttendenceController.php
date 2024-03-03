<?php

namespace App\Http\Controllers\nextbook\Employee;
use App\Models\nextbook\Employee;
use App\Models\nextbook\Attendence;
use App\Models\nextbook\Months;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Show;
use Illuminate\Http\Request;
class EmployeeAttendenceController extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Attendence);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         //$actions->disableView();
       });
        $grid->id('ID');
        $grid->month()->name(__("employee.month_id"));
        $grid->year(__("employee.year"));
        
        
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
              
        $form = new Form(new Attendence);
        $form->setWidth(10, 6);
        if($form->isCreating()){
            $form->setAction(admin_url("employee/attendencesave"));
        }
         $form->column(1/3, function ($form) {
        $form->select("year",__("employee.year"))->options(array(date("Y")=>date("Y"),date("Y")-1=>date("Y")-1))->attribute(["id"=>"year",'onchange'=>'changeselect()']);
         });
          $form->column(1/3, function ($form) {
          $form->select("month_id",__("employee.month_id"))->options(Months::dropdown())->attribute(["id"=>"month_id",'onchange'=>'changeselect()']);
          });
          if($form->isCreating()){
          $form->column(12,function($form){
             $form->hasMany("attendencedetaial",__("employee.attendcnedetial"), function (Form\NestedForm $form) {
             $Javascript=new \App\Helpers\nextbook\employee\EmployeeInfo();
             $form->html("<div id='info' style='width:100%'></div>".$Javascript->loademployeeforattendecen())->plain();
             })->defaultrows(3);
             });
          }else{
               
                 $form->column(12,function($form){
                 $form->hasMany("attendencedetaial",__("employee.attendcnedetial"), function (Form\NestedForm $form) {
                 $form->html($this->name($form->attendencedetaial()->getKey()),__("employee.employeename"))->plain();
                 $form->html($this->fathername($form->attendencedetaial()->getKey()),__("employee.fathername"))->plain();
                 $form->text("present");
                 $form->text("absent");
                 $form->text("onleave");
                 
             })->mode('table')->disableCreate()->disableDelete();
             });
          }
          $form->hidden("company_id")->default($this->companyid());
          $form->hidden("user_id")->default($this->userid());
        return $form;
    }
    
    private function name($id){
            $record="";
          if(is_numeric($id)){
        $record= \Illuminate\Support\Facades\DB::table("attendance_detials")->where("id",$id)->first()->employee_id;
         $record= Employee::findOrFail($record)->name;
          }
          return $record;
    }
       private function fathername($id){
          $record="";
          if(is_numeric($id)){
        $record= \Illuminate\Support\Facades\DB::table("attendance_detials")->where("id",$id)->first()->employee_id;
         $record= Employee::findOrFail($record)->fname;
          }
          return $record;
    }
    public function attendencesave(Request $request){

       $data=$request->all();
       $monthid=$data['month_id'];
       $year=$data['year'];
       $allemployeeid=$data["employeeid"];
       $allpresent=$data['present'];
       $allonleave=$data['onleave'];
       $allabsent=$data['absent'];
       $attendence=new Attendence();
       $attendence->year=$year;
       $attendence->month_id=$monthid;
       $attendence->company_id=$this->companyid();
       $attendence->user_id=$this->userid();
       $attendence->save();
      $attendenceid= $attendence->id;
      $index=0;
      foreach($allemployeeid as $employee_id){
          $attendence_detial=new \App\Models\nextbook\Attendencedetails();
          $attendence_detial->employee_id=$employee_id;
          $attendence_detial->attendance_id=$attendenceid;
          $attendence_detial->present=$allpresent[$index];
          $attendence_detial->onleave=$allonleave[$index];
          $attendence_detial->absent=$allabsent[$index];
          $attendence_detial->user_id=$this->userid();
          $attendence_detial->save();
          
          $index++;
      }
      
     return redirect(admin_url("nextbook/attendece"));

       
    }
   
}
