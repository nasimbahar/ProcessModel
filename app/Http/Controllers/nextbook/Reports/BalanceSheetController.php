<?php
namespace App\Http\Controllers\nextbook\Reports;
use App\Models\nextbook\Accountjournal;
use App\Models\nextbook\Companycharts;
use App\Models\nextbook\Balancesheet;

use Encore\Admin\Show;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Widgets\Table;
use Illuminate\Support\Facades\DB;
use App\Helpers\nextbook\Insertledger;

class BalanceSheetController extends AdminController
{
     protected function grid()
    {
           Insertledger::insertBalancesheet();

        $allassetAccounts=Balancesheet::where("year_id",getfinancilyear())->where($this->wherecon())->where("account_type_id",1)->get();
        $sumofasset=0;
        $headers = ['Id', 'Asset Accounts', 'Amount'];
       $rows=array();
       $id=1;
       foreach($allassetAccounts as $item){
           $rows[]=array($id,$this->getAccountname($item->account_id),$item->amount);
       $sumofasset+=$item->amount;
           $id++;
       }
       $sumoflibilties=0;
      $alllibalitiesAccounts= Balancesheet::where("year_id",getfinancilyear())->where($this->wherecon())->where("account_type_id",2)->get();

       $table = new Table($headers, $rows);
        $headers2 = ['Id', 'Liability', 'Amount'];
       $rows2=array();
       $id=1;
       foreach($alllibalitiesAccounts as $item){
           $rows2[]=array($id,$this->getAccountname($item->account_id),$item->amount);
       $sumoflibilties+=$item->amount;
           $id++;
       }
       

       $table2 = new Table($headers2, $rows2);
       
             $allonwerequityaccounts= Balancesheet::where("year_id",getfinancilyear())->where($this->wherecon())->where("account_type_id",5)->get();
    $sumofonwerequity=0;
         $headers3 = ['Id', 'Owner Equity', 'Amount'];
       $rows3=array();
       $id=1;
       foreach($allonwerequityaccounts as $item){
           $rows3[]=array($id,$this->getAccountname($item->account_id),$item->amount);
       $sumofonwerequity+=$item->amount;
           $id++;
       }

       $table3 = new Table($headers3, $rows3);
      return $table->render().$table2->render().$table3->render().$this->bottomhtml($sumofasset, $sumoflibilties, $sumofonwerequity);
    }

    private function getAccountname($id){
      if(DB::table("company_charts")->where("id",$id)->first()!=null)  
      return DB::table("company_charts")->where("id",$id)->first()->name;
      return "";
    }
    
    private function bottomhtml($asset,$libaity,$onwerequity){
        
      $html=  '<div class="callout callout-info">
        <h4>Balance!</h4>
       Assets:'.$asset.'=Liability:'.$libaity.'+'.'Owner Equity'.$onwerequity.'
      </div>';
      return $html;
    }
    
  
}
