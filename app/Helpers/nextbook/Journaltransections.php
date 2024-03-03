<?php

namespace App\Helpers\nextbook;
use App\Models\nextbook\Accountjournal;
use Illuminate\Support\Facades\DB;

 class Journaltransections{
    public $record_id=0;
    public $module_id=0;
    public $debit_account_id;
    public $credit_account_id;
    public $currency_id;
    public $description;
    public $note;
    public $debit_amount;
    public $credit_amount;
    public $project_id;
    public $payable_account_id;
    public $payable_amount;
    public $compnay_id;
    public $date;
    public $user_id;
    public $receivable_account_id;
    public $receivable_amount;


    public function insert(){
      $accountJournal=new Accountjournal();
      $accountJournal->record_id=$this->record_id;
      $accountJournal->module_id=$this->module_id;
      $accountJournal->debit_account_id=$this->debit_account_id;
      $accountJournal->credit_account_id=$this->credit_account_id;
      $accountJournal->currency_id=$this->currency_id;
      $accountJournal->debit_amount=$this->debit_amount;
      $accountJournal->credit_amount=$this->credit_amount;
      $accountJournal->description=$this->description;
      $accountJournal->project_id=$this->project_id;
      $accountJournal->note=$this->note;
      $accountJournal->user_id=$this->user_id;
      $accountJournal->payable_account_id=$this->payable_account_id;
      $accountJournal->payable_amount=$this->payable_amount;
      $accountJournal->receivable_account_id=$this->receivable_account_id;
      $accountJournal->receivable_amount=$this->receivable_amount;
      $accountJournal->company_id=$this->compnay_id;
      $accountJournal->year_id= getfinancilyear();
      $accountJournal->user_id= \Encore\Admin\Facades\Admin::user()->id;
      $accountJournal->save();
     }
     
     public function update(){
         $data=array("debit_account_id"=>$this->debit_account_id,
             "credit_account_id"=>$this->credit_account_id,
             "currency_id"=>$this->currency_id,
             "debit_amount"=>$this->debit_amount,
             "description"=>$this->description,
             "note"=>$this->note,
             "user_id"=>$this->user_id,
             "credit_amount"=>$this->credit_amount,
             "payable_account_id"=>$this->payable_account_id,
             "payable_amount"=>$this->payable_amount,
             "receivable_account_id"=>$this->receivable_account_id,
             "receivable_amount"=>$this->receivable_amount,
            "user_id"=> \Encore\Admin\Facades\Admin::user()->id
         );
         DB::table("account_journal")->where(array("record_id"=>$this->record_id,"module_id"=>$this->module_id))->update($data);
     }
 }