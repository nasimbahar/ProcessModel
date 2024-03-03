<?php

namespace App\ExtraGridActions\nextbook;


use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\nextbook\Invoice;
use App\Models\nextbook\Companycharts;

use App\Models\nextbook\Invoicepayments;
use Encore\Admin\Facades\Admin;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB;

class Invoicepayment extends RowAction
{
    public $name ;
    public $id;
    function __construct($id=0) {
        parent::__construct();
        $this->name=__("invoice.invoicepayemnt");
        $this->id=$id;
    }
    public function handle(Model $model, Request $request)
    {
       $invoice_id=$request->get('invoice_id');
       $paid=$request->get('paid');
         $account_type_id=$request->get("account_type_id");
          $date=$request->get("date");
          $description=$request->get("description");

       $balance= \App\Models\nextbook\Invoice::where('id',$invoice_id)->first()->balance;
       $oldpaid= \App\Models\nextbook\Invoice::where('id',$invoice_id)->first()->paid;
       if($balance==0){
          return $this->response()->error('This balance is already Zero')->refresh();  
       }
       if($balance-$paid<0){
             return $this->response()->error('The balance is now greater then total amount')->refresh();  
       }
         DB::beginTransaction();
      try{
       $invoicepayements=new Invoicepayments();
       $invoicepayements->invoice_id=$invoice_id;
       $invoicepayements->amount=$paid;
       $invoicepayements->balance=$balance-$paid;
       $invoicepayements->user_id=Admin::user()->id;
        $invoicepayements->debit_type_id=$account_type_id;
       $invoicepayements->date=$date;
       $invoicepayements->description=$description;
       $invoicepayements->save();
       
       \Illuminate\Support\Facades\DB::table("invoice")->where("id",$invoice_id)->update(array("balance"=>$balance-$paid,'paid'=>$oldpaid+$paid));
       $this->journaltransection($invoice_id,$account_type_id,$date,$description,$paid,$balance);
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
   $record=  \Illuminate\Support\Facades\DB::table("invoice")->where("id",$this->id)->first();
    $this->hidden("invoice_id")->default($this->id);
    $this->text("total",__("invoice.total"))->default($record->total)->readonly();
    $this->select("account_type_id",__("expenses.account_type_id"))->options(Companycharts::cashaccounts($record->currency_id))->rules("required");
    $this->text("balance",__("invoice.balance"))->default($record->balance)->readonly();
    $this->text("paid",__("invoice.paid"));
    $this->date("date",__("expenses.date"))->rules("required");

    $this->textarea('description', __('invoice.description'))->rules('required');
    }
}
   private function journaltransection($id,$account_type_id,$date,$description,$paid,$balance){
       $record= \App\Models\nextbook\Invoice::where("id",$id)->get()->first();
       if($record!=null){
          $Journaltransections=new \App\Helpers\nextbook\Journaltransections();
          $Journaltransections->debit_account_id= $account_type_id;
          $Journaltransections->debit_amount=$paid;
          $Journaltransections->credit_account_id=getRecvibaleAccount($record->currency_id);
          $Journaltransections->credit_amount=$paid;
          $Journaltransections->currency_id=$record->currency_id;
//          if($balance-$paid!=0){
//          $Journaltransections->payable_account_id= getPayableAccount($record->currency_id);
//          $Journaltransections->payable_amount=$balance-$paid;
//          }
          $Journaltransections->record_id=$id;
          $Journaltransections->module_id= \App\Helpers\nextbook\Allmodules::Invoices;
          $Journaltransections->compnay_id=$record->company_id;
          $Journaltransections->project_id=$record->project_id;
          $Journaltransections->description=$description;
          $Journaltransections->note=$description;
          $Journaltransections->date=$date;
         
          $Journaltransections->insert();
         
       }
   }
}