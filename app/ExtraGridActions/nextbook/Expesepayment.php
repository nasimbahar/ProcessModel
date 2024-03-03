<?php

namespace App\ExtraGridActions\nextbook;


use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\nextbook\Expenses;
use App\Models\nextbook\Companycharts;

use App\Models\nextbook\Expensepayments;
use Encore\Admin\Facades\Admin;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB;

class Expesepayment extends RowAction
{
    public $name ;
    public $id;
    function __construct($id=0) {
        parent::__construct();
        $this->name=__("expenses.expesepayment");
        $this->id=$id;
    }

    public function handle(Model $model, Request $request)
    {
       $expenseid=$request->get('expense_id');
       $paid=$request->get('paid');
       $date=$request->get("date");
       $account_type_id=$request->get("account_type_id");
       $description=$request->get("description");
       $balance= \App\Models\Expenses::where('id',$expenseid)->first()->balance;
       $oldpaid= \App\Models\nextbook\Expenses::where('id',$expenseid)->first()->paid;

       if($balance==0){
          return $this->response()->error('This balance is already Zero')->refresh();  
       }
       if($balance-$paid<0){
             return $this->response()->error('The balance is now greater then total amount')->refresh();  

       }
       DB::beginTransaction();
       try{
       $Expensepayments=new Expensepayments();
       $Expensepayments->expense_id=$expenseid;
       $Expensepayments->amount=$paid;
       $Expensepayments->balance=$balance-$paid;
       $Expensepayments->user_id=Admin::user()->id;
       $Expensepayments->account_type_id=$account_type_id;
       $Expensepayments->description=$description;  
       $Expensepayments->date=$date;
       $Expensepayments->save();
       DB::table("expenses")->where("id",$expenseid)->update(array("balance"=>$balance-$paid,'paid'=>$oldpaid+$paid));
       $this->journaltransection($expenseid,$account_type_id,$date,$description,$paid,$balance);
       DB::commit();
       }catch (\Exception $e) {
           
        DB::rollback();
              return $this->response()->error('Some Error Occur')->refresh();

    }
        return $this->response()->success('Success message.')->refresh();
    }
 public function form()
{
    if($this->id!=0){
   $record=  DB::table("expenses")->where("id",$this->id)->first();
    $this->hidden("expense_id")->default($this->id);
    $this->text("total",__("expenses.total"))->default($record->total)->readonly();
    $this->select("account_type_id",__("expenses.account_type_id"))->options(Companycharts::cashaccounts($record->currency_id))->rules("required");
    $this->text("balance",__("expenses.balance"))->value($record->balance)->readonly();
    $this->text("paid",__("expenses.paid"))->rules("required");
    $this->date("date",__("expenses.date"))->rules("required");
    $this->textarea('description', __('expenses.description'))->rules('required');
    }
}
   private function journaltransection($id,$account_type_id,$date,$description,$paid,$balance){
       $record= \App\Models\nextbook\Expenses::where("id",$id)->get()->first();
       if($record!=null){
          $Journaltransections=new \App\Helpers\nextbook\Journaltransections();
          $Journaltransections->debit_account_id=getPayableAccount($record->currency_id);
          $Journaltransections->debit_amount=$paid;
          $Journaltransections->credit_account_id=$account_type_id;
          $Journaltransections->credit_amount=$paid;
          $Journaltransections->currency_id=$record->currency_id;
//          if($balance-$paid!=0){
//          $Journaltransections->payable_account_id= getPayableAccount($record->currency_id);
//          $Journaltransections->payable_amount=$balance-$paid;
//          }
          $Journaltransections->record_id=$id;
          $Journaltransections->module_id= \App\Helpers\nextbook\Allmodules::Expenses;
          $Journaltransections->compnay_id=$record->company_id;
          $Journaltransections->project_id=$record->project_id;
          $Journaltransections->description=$description;
          $Journaltransections->note=$description;
          $Journaltransections->date=$date;
         
          $Journaltransections->insert();
         
       }
   }
}