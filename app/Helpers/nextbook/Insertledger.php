<?php

namespace App\Helpers\nextbook;
use App\Models\nextbook\Accountjournal;
use App\Models\nextbook\Companycharts;
use App\Models\nextbook\Ledgers;
use App\Models\nextbook\Balancesheet;
use App\Models\nextbook\Netincome;

use Illuminate\Support\Facades\DB;


 class Insertledger extends BaseClass{
    


    public static function  insertledgerr(){
     $yearid=   getfinancilyear();
  
    DB::table('ledgers')->where('year_id', $yearid)->delete();
    $allchartofaccounts= Companycharts::where(Insertledger::wherecon())->orWhere("company_id",0)->get();
    foreach($allchartofaccounts as $item){
              $change=0;
              $debitamount= \Illuminate\Support\Facades\DB::table("account_journal")->where(array("debit_account_id"=>$item->id,'year_id'=>$yearid))->where(Insertledger::wherecon())->sum("debit_amount");
           if($item->id==209 || $item->id==242){
             $debitamount+= \Illuminate\Support\Facades\DB::table("account_journal")->where(array("receivable_account_id"=>$item->id,'year_id'=>$yearid))->where(Insertledger::wherecon())->sum("receivable_amount");
             }
               $creditamount= \Illuminate\Support\Facades\DB::table("account_journal")->where(array("credit_account_id"=>$item->id,'year_id'=>$yearid))->where(Insertledger::wherecon())->sum("credit_amount");
           if($item->id==207 || $item->id==240){
          $creditamount+= \Illuminate\Support\Facades\DB::table("account_journal")->where(array("payable_account_id"=>$item->id,'year_id'=>$yearid))->where(Insertledger::wherecon())->sum("payable_amount");
         }
             if($item->account_type_id==1 || $item->account_type_id==4){
                 $change =$debitamount-$creditamount;
             }
             else{
                 $change= $creditamount-$debitamount;
             }
        $ledgers=new Ledgers();
        $ledgers->account_id=$item->id;
        $ledgers->year_id= $yearid;
        $ledgers->account_type_id=$item->account_type_id;
        $ledgers->currency_id=$item->currency_id;
        $ledgers->debit=$debitamount;
        $ledgers->credit=$creditamount;
        $ledgers->changeamount=$change;
        $ledgers->user_id=\Encore\Admin\Facades\Admin::user()->id;
        $ledgers->company_id= \Encore\Admin\Facades\Admin::user()->company_id;
        $ledgers->save();
    }
     
    
    }
        public static function  insertBalancesheet(){
     $yearid=   getfinancilyear();
    DB::table('balance_sheet')->where('year_id', $yearid)->delete();
    $alllegers= Ledgers::where("year_id",$yearid)->where(Insertledger::wherecon())->get();
   // return $allchartofaccounts;
    foreach($alllegers as $item){
        $balncesheet=new Balancesheet();
        $balncesheet->account_id=$item->account_id;
        $balncesheet->year_id= $yearid;
        $balncesheet->account_type_id=$item->account_type_id;
        $balncesheet->currency_id=$item->currency_id;
        $balncesheet->amount=$item->changeamount;
        $balncesheet->user_id=\Encore\Admin\Facades\Admin::user()->id;
        $balncesheet->company_id= \Encore\Admin\Facades\Admin::user()->company_id;
        $balncesheet->save();
    }
    
    
     
    
    }
     
         public static function  insertNetIncome(){
     $yearid=   getfinancilyear();
    DB::table('netincome')->where('year_id', $yearid)->delete();
    $alllegers= Ledgers::where("year_id",$yearid)->where(Insertledger::wherecon())->get();
   // return $allchartofaccounts;
    foreach($alllegers as $item){
        $balncesheet=new Netincome();
        $balncesheet->account_id=$item->account_id;
        $balncesheet->year_id= $yearid;
        $balncesheet->account_type_id=$item->account_type_id;
        $balncesheet->currency_id=$item->currency_id;
        $balncesheet->amount=$item->changeamount;
        $balncesheet->user_id=\Encore\Admin\Facades\Admin::user()->id;
        $balncesheet->company_id= \Encore\Admin\Facades\Admin::user()->company_id;
        $balncesheet->save();
    }
    
    
     
    
    }
 }