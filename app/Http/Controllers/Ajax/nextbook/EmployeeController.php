<?php

namespace App\Http\Controllers\Ajax\nextbook;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\nextbook\Employee;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Box;
class EmployeeController extends \Encore\Admin\Controllers\AdminController
{
   private $absent=0;
     private $advance=0;
     private $bonus=0;
     private $penalty=0;
     private $tax=0;
     private $payable=0;
     private $present=0;
     private $total=0;
     public function info(Request $request)
{
    $employeeid = $request->get('id');
    $show = new Show(Employee::findOrFail($employeeid));
     $show->panel()
    ->tools(function ($tools) {
        $tools->disableEdit();
        $tools->disableList();
        $tools->disableDelete();
    });;
        $show->name(__("employee.employeename")); 
        $show->fname(__("employee.fathername")); 
        $show->photo(__("employee.photo"))->image('',50,50);
        return $show;
}
    
 public function employee(Request $request)
{
    $q = $request->get('q');

    return \App\Models\nextbook\Employee::where('name', 'like', "%$q%")->where("company_id",$this->companyid())->paginate(null, ['id', 'name as text']);
}

public function employeeforAttendence(Request $request){
   $month_id= $request->get('month_id');
   $year= $request->get('year');
   if($month_id>0 && $year>0){
         if(!$this->Isworkingdayscalculted($month_id, $year)) {
       return $this->errorhtml(__('employee.workingdaysnotcalculted'));
   
    }
     else  if($this->Isdublicateattendnce($month_id, $year)){
            return $this->errorhtml(__('employee.duplicateattence'));

         }
       else{
       return $this->Attendencetable($month_id, $year);
       }
   }
   return "";

}
public function employeeforpayroll(Request $request){
   $month_id= $request->get('month_id');
   $year= $request->get('year');
   $isupdate=$request->get('isupdate');
   $project_id=$request->get('project_id');
   if($month_id>0 && $year>0 && $project_id>0){
        if($isupdate==1){
           return $this->payrolltable($month_id,$year,$project_id);  
        }
       else if(!$this->Isdublicateattendnce($month_id, $year)){
            return $this->errorhtml(__('employee.noattendecne'));

         }
         else if($this->Isdublicatepayroll($month_id, $year,$project_id)){
              return $this->errorhtml(__('employee.payrolldublicate'));

         }
         else{
             return $this->payrolltable($month_id,$year,$project_id);
         }
   }
    return "";
}
private function Attendencetable($monthid,$year){
    $box = new Box(__('employee.defualvalues'), '<input type="text" value="26" id="dpresent">&nbsp'.'<input type="text" value="0" id="dabsent">&nbsp'.'<input type="text" value="0" id="donleave">&nbsp<input type="button" class="dynamicElement btn btn-info btn-sm" id="dbutton" value="'.__('employee.change').'">');
    
    $headers = [__("employee.id"), __('employee.employeename'),__('employee.fathername'),__('employee.present'),__('employee.absent'),__('employee.onleave') ];
$row=[];
$allemployee= \Illuminate\Support\Facades\DB::table("employee")->where('company_id',$this->companyid())->where("status",1)->get();
  $id=1;
  //expensedetials[new_1][bill_no]
  $relatinname='attendencedetaial[new_'.$id.'][present]';
    foreach($allemployee as $employee){
    $row[]=array($id,
    $employee->name,
    $employee->fname,
    "<input type='number' value='26' class='present' name='present[]' required='required'><input type='hidden' value='".$employee->id."' name='employeeid[]'>",
   "<input type='number' value='0' class='absent' id='absent' name='absent[]' required='required'>",
   "<input type='number' value='0' class='onleave' name='onleave[]' required='required'>",
        

  );
 $id++; 
}
    
   $table = new Table($headers, $row);
    return  $box.$table->render();
    
}
private function payrolltable($monthid,$year,$project_id){
    $box = new Box(__('employee.defualvalues'), '<input type="text" value="26" id="dpresent">&nbsp'.'<input type="text" value="0" id="dabsent">&nbsp'.'<input type="text" value="0" id="donleave">&nbsp<input type="button" class="dynamicElement btn btn-info btn-sm" id="dbutton" value="'.__('employee.change').'">');
    
   $headers = [__("employee.ispaid"),__("employee.id"), __('employee.employeename'),__('employee.fathername'),__('employee.salary'),__('employee.working_days')
       ,__('employee.present'),__('employee.absent'),__('employee.onleave')
       ,__('employee.payable'),__('employee.tax'),__("employee.advance"),__("employee.bonues"),__("employee.penalty"),__("employee.total")];
   $row=[];
   $allemployee= \Illuminate\Support\Facades\DB::table("employee")->where('company_id',$this->companyid())->where("status",1)->where("project_id",$project_id)->get();
   $id=1;
   $attendence_id=    $reocrds= \Illuminate\Support\Facades\DB::table("attendance")->where("company_id",$this->companyid())->where("year",$year)->where("month_id",$monthid)->get()->first()->id;
   $workingdays= \Illuminate\Support\Facades\DB::table("workingdays")->where(array('month_id'=>$monthid,'year'=>$year,'company_id'=>$this->companyid()))->first()->working_days;
   $relatinname='attendencedetaial[new_'.$id.'][present]';
    foreach($allemployee as $employee){
      
    $row[]=array(
          "<input type='checkbox' value='".$employee->id."' name='ispaid[]'>",
        $id,
    $employee->name,
    $employee->fname,
    $employee->salary,
    $workingdays,
    $this->finddays(array("employee_id"=>$employee->id,"attendance_id"=>$attendence_id), 'present')
        ,
   $this->finddays(array("employee_id"=>$employee->id,"attendance_id"=>$attendence_id), 'absent'),
   $this->finddays(array("employee_id"=>$employee->id,"attendance_id"=>$attendence_id), 'onleave'),
    $this->getpayable($employee->salary, $workingdays, $this->absent),
    $this->tax($employee->salary),
    $this->findadditionalpayment(array("employee_id"=>$employee->id,'month_id'=>$monthid,'year'=>$year), 1),
    $this->findadditionalpayment(array("employee_id"=>$employee->id,'month_id'=>$monthid,'year'=>$year), 2),
    $this->findadditionalpayment(array("employee_id"=>$employee->id,'month_id'=>$monthid,'year'=>$year), 3),
    $this->total()
   
        . "<input type='hidden' value='".$employee->id."' name='employeeid[]'>"
        . "<input type='hidden' value='".$employee->salary."' name='salary[]'>"
        . "<input type='hidden' value='".$workingdays."' name='workingdays[]'>"
        . "<input type='hidden' value='".$this->present."' name='present[]'>"
        . "<input type='hidden' value='".$this->payable."' name='payable[]'>"
        . "<input type='hidden' value='".$this->tax."' name='tax[]'>"
        . "<input type='hidden' value='".$this->advance."' name='advance[]'>"
        . "<input type='hidden' value='".$this->bonus."' name='bones[]'>"
        . "<input type='hidden' value='".$this->penalty."' name='penalty[]'>"
        . "<input type='hidden' value='".$this->total."' name='total[]'>" 



  );
 $id++; 
}
    
   $table = new Table($headers, $row);
    return  $table->render();
    
}
private function total(){
    $this->total= $this->payable-$this->tax-$this->advance-$this->penalty+$this->bonus ;
    return $this->total;
}
private function finddays($where,$column){
    
   $record=\Illuminate\Support\Facades\DB::table("attendance_detials")->where($where)->first()->$column;
   if($column=='absent'){
       $this->absent=$record;
    }
    else if($column=='present'){
        $this->present=$record;
    }
    return $record;
}
private function getpayable($salary,$workigdays,$absentdays){
   // return 0;
    $record= $salary-($salary/$workigdays)*$absentdays;
    $payable=intval($record);
    $this->payable=$payable;
    return $payable;
}
private function findadditionalpayment($where,$type_id){
 $record=\Illuminate\Support\Facades\DB::table("employee_additional_payments")->where($where)->where("type_id",$type_id)->get()->count();
   if($record>0){
 $record= \Illuminate\Support\Facades\DB::table("employee_additional_payments")->where($where)->where('type_id',$type_id)->sum('amount');
   if($type_id==1){
      $this->advance=$record; 
   }
   else if($type_id==2){
      $this->bonus=$record; 
   }
   else{
      $this->penalty=$record; 
   }
 
 
   }
   else{
        if($type_id==1){
      $this->advance=0;
   }
   else if($type_id==2){
      $this->bonus=0;
   }
   else{
      $this->penalty=0;
   }
 
   }
 
   return $record;
}

private function Isdublicateattendnce($monthid,$year){
 
   $reocrds= \Illuminate\Support\Facades\DB::table("attendance")->where("company_id",$this->companyid())->where("year",$year)->where("month_id",$monthid)->get()->count();
  if($reocrds>0){
      return true;
  }
  return false;
   
}

private function Isdublicatepayroll($monthid,$year,$project_id){
      $reocrds= \Illuminate\Support\Facades\DB::table("payrolls")->where("company_id",$this->companyid())->where("project_id",$project_id)->where("year",$year)->where("month_id",$monthid)->get()->count();
  if($reocrds>0){
      return true;
  }
  return false;
   

}

private function Isworkingdayscalculted($monthid,$year){
    
   $reocrds= \Illuminate\Support\Facades\DB::table("workingdays")->where("company_id",$this->companyid())->where("year",$year)->where("month_id",$monthid)->get()->count();
  if($reocrds>0){
      return true;
  }
  return false;
   
}

private function errorhtml($msg){
    $html='<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>'.$msg.'
               
              </div>';
    return $html;
}

private function attendencescript(){
      $var =  "<script>
             $(function(){
             alert();
             $('button').click(function(){
        
             $('.present').val($('#dpresent').val());
            
             });
             

});
</script>";
      return $var;
}

private function  tax($salary){
    $tax=0;
    if($salary<=5000){
        return 0;
    }
    else if($salary>5000 && $salary<=12500){
        $tax= ($salary/100)*2;
    }
    else if($salary>12500 && $salary<=100000){
        $salary=$salary-12500;
        $tax= ($salary/100)*10+150;
    }
    else{
         $salary=$salary-100000;
         $tax= ($salary/100)*20+8900;
    }
    $this->tax=$tax;
    return $tax;
}
}
