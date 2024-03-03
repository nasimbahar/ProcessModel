<?php

namespace App\Http\Controllers\nextbook\Employee;
use App\Models\nextbook\Employee;
use App\Models\nextbook\Companycharts;
use App\Models\nextbook\Employeepositions;
use App\Models\nextbook\Payroll;
use App\Models\nextbook\Months;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;
class PayrollController extends AdminController
{
   public $total=0;
   public $paid=0;
   public $payrollid=0;
   public $project_id=0;
     protected function grid()
    {
       $grid = new Grid(new Payroll);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         //$actions->disableView();
       });
        $grid->id('ID');
        $grid->year(__("employee.year"));
        $grid->month()->name(__("employee.month_id"));
        $grid->column(__("employee.tax"))->display(function ($payrolldetial) {
      $total= \Illuminate\Support\Facades\DB::table("payrolls_details")->where('payroll_id',$this->id)->sum('tax');
    return "<span class='label label-success'>{$total}</span>";
});
$grid->column(__("employee.advance"))->display(function ($payrolldetial) {
      $total= \Illuminate\Support\Facades\DB::table("payrolls_details")->where('payroll_id',$this->id)->sum('advance');
    return "<span class='label label-success'>{$total}</span>";
});

       $grid->column(__("employee.total"))->display(function ($payrolldetial) {
      $total= \Illuminate\Support\Facades\DB::table("payrolls_details")->where('payroll_id',$this->id)->sum('total');
    return "<span class='label label-info'>{$total}</span>";
});
       
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
              
        $form = new Form(new Payroll);
        $form->setWidth(10, 6);
        if($form->isCreating()){
            $form->setAction(admin_url("payroll/savepayroll"));
        }
        else{
           $form->setAction(admin_url("payroll/updatepayroll"));  
        }
       
         $form->column(1/4, function ($form) {
             if($form->isCreating()){
             $form->select("year",__("employee.year"))->options(array(date("Y")=>date("Y"),date("Y")-1=>date("Y")-1))->attribute(["id"=>"year",'onchange'=>'changeselect()']);

             }else{
                 
         $form->select("year",__("employee.year"))->options(array(date("Y")=>date("Y"),date("Y")-1=>date("Y")-1))->attribute(["id"=>"year",'onchange'=>'changeselect()','disabled'=>'disabled']);
                 
                  }
         });
      
          $form->column(1/4, function ($form) {
               if($form->isCreating()){
          $form->select("month_id",__("employee.month_id"))->options(Months::dropdown())->attribute(["id"=>"month_id",'onchange'=>'changeselect()']);
               }
               else{
           $form->select("month_id",__("employee.month_id"))->options(Months::dropdown())->attribute(["id"=>"month_id",'onchange'=>'changeselect()','readonly'=>'disabled']);
   
               }
               
                 $form->column(1/4, function ($form) {
               if($form->isCreating()){
             $form->select('project_id',__("employee.project_id"))->options(\App\Models\nextbook\Projects::dropdown())->attribute(["id"=>"project_id",'onchange'=>'changeselect()']);;
               }
               else{
              $form->select('project_id',__("employee.project_id"))->options(\App\Models\nextbook\Projects::dropdown());
   
               } });
          
               });
                  $form->column(1/4, function ($form) {
                    $form->select("account_type_id",__("employee.credit_type_id"))->options(Companycharts::cashaccounts(3))->rules("required");

      
         });
       
          $form->column(12,function($form){
             $Javascript=new \App\Helpers\nextbook\employee\EmployeeInfo();
             $form->html("<div id='info' style='width:100%'></div>".$Javascript->loademployeeforpayroll())->plain();
             });
            
         
        if($form->isEditing()){
            
           $form->submitted(function (Form $form) {
           $form->ignore('year','month_id','employee_id');
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
      public function savepayroll(Request $request){
       $data=$request->all();
       $ispaid=false;
       $monthid=$data['month_id'];
       if(isset($data['ispaid'])){
          $ispaid=true;
          $paid=$data['ispaid'];
       }
       $year=$data['year'];
       $account_type_id=$data['account_type_id'];
       $employeeid=$data["employeeid"];
       $this->project_id=$data['project_id'];
       $present=$data['present'];
       $salary=$data['salary'];
       $workingdays=$data['workingdays'];
       $payable=$data['payable'];
       $tax=$data['tax'];
       $advance=$data['advance'];
       $bones=$data['bones'];
       $penalty=$data['penalty'];
       $total=$data['total'];
       $payroll=new Payroll();
       $payroll->year=$year;
       $payroll->month_id=$monthid;
       $payroll->company_id=$this->companyid();
       $payroll->account_type_id=$account_type_id;
       $payroll->project_id=$this->project_id;
       $payroll->user_id=$this->userid();
       $payroll->save();
       $payrollid= $payroll->id;
       $this->payrollid=$payrollid;
      $index=0;
      foreach($employeeid as $employee_id){
          $this->total+=$total[$index];
          $payrolldetials=new \App\Models\nextbook\Payrolldetials();
          if($ispaid){
              if(isset($paid[$index])){
                  $payrolldetials->ispaid=1;
                  $this->paid+=$total[$index];
              }
          }
          $payrolldetials->employee_id=$employee_id;
          $payrolldetials->payroll_id=$payrollid;
          $payrolldetials->present_days=$present[$index];
          $payrolldetials->salary=$salary[$index];
          $payrolldetials->working_days=$workingdays[$index];
          $payrolldetials->payable=$payable[$index];
          $payrolldetials->tax=$tax[$index];
          $payrolldetials->advance=$advance[$index];
          $payrolldetials->bones=$bones[$index];
          $payrolldetials->penalty=$penalty[$index];
          $payrolldetials->total=$total[$index];
          $payrolldetials->credit_type_id=$account_type_id;
          $payrolldetials->debit_type_id=212;
          $payrolldetials->user_id=$this->userid();
          $payrolldetials->save();
          
          $index++;
      }
          $this->journaltransection("insert");

     return redirect(admin_url("nextbook/payroll"));

       
    }
    
      public function updatepayroll(Request $request){
       $data=$request->all();
       $ispaid=false;
       if(isset($data['ispaid'])){
          $ispaid=true;
          $paid=$data['ispaid'];
       }
      return $this->id;
       $account_type_id=$data['account_type_id'];
       $employeeid=$data["employeeid"];
       $present=$data['present'];
       $salary=$data['salary'];
       $workingdays=$data['workingdays'];
       $payable=$data['payable'];
       $tax=$data['tax'];
       $advance=$data['advance'];
       $bones=$data['bones'];
       $penalty=$data['penalty'];
       $total=$data['total'];
       $payroll=new Payroll();
       $payroll->year=$year;
       $payroll->month_id=$monthid;
       $payroll->company_id=$this->companyid();
       $payroll->project_id=$this->project_id;
       $payroll->account_type_id=$account_type_id;
       $payroll->user_id=$this->userid();
       $payroll->save();
       $payrollid= $payroll->id;
       $this->payrollid=$payrollid;
      $index=0;
      foreach($employeeid as $employee_id){
          $this->total+=$total[$index];
          $payrolldetials=new \App\Models\nextbook\Payrolldetials();
          if($ispaid){
              if(isset($paid[$index])){
                  $payrolldetials->ispaid=1;
                  $this->paid+=$total[$index];
              }
          }
          $payrolldetials->employee_id=$employee_id;
          $payrolldetials->payroll_id=$payrollid;
          $payrolldetials->present_days=$present[$index];
          $payrolldetials->salary=$salary[$index];
          $payrolldetials->working_days=$workingdays[$index];
          $payrolldetials->payable=$payable[$index];
          $payrolldetials->tax=$tax[$index];
          $payrolldetials->advance=$advance[$index];
          $payrolldetials->bones=$bones[$index];
          $payrolldetials->penalty=$penalty[$index];
          $payrolldetials->total=$total[$index];
          $payrolldetials->credit_type_id=$account_type_id;
          $payrolldetials->debit_type_id=212;
          $payrolldetials->user_id=$this->userid();
          $payrolldetials->save();
          
          $index++;
      }
          $this->journaltransection("insert");

     return redirect(admin_url("nextbook/payroll"));

       
    }
       private function journaltransection($type){
       $record= \App\Models\nextbook\Payroll::where("id",$this->payrollid)->get()->first();
       if($record!=null){
          $Journaltransections=new \App\Helpers\nextbook\Journaltransections();
          $Journaltransections->debit_account_id=212;//salary expesnse account id
          $Journaltransections->debit_amount=$this->total;
          $Journaltransections->credit_account_id=$record->account_type_id;
          $Journaltransections->credit_amount=$this->paid;
          $Journaltransections->project_id=$this->project_id;
          $Journaltransections->currency_id=3;
           if($this->total-$this->paid!=0){
          $Journaltransections->payable_account_id= getPayableAccount(3);
          $Journaltransections->payable_amount=$this->total-$this->paid;
           }
          $Journaltransections->record_id=$this->payrollid;
          $Journaltransections->module_id= \App\Helpers\nextbook\Allmodules::Salary;
          $Journaltransections->compnay_id=$this->companyid();
        
          $Journaltransections->description="Salary Expense";
          $Journaltransections->note="Salary Expense";
          if($type=="insert"){
          $Journaltransections->insert();
          }
          else{
              $Journaltransections->update();
          }
       }
   }
}
