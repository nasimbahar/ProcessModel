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


class NetIncomeController extends AdminController
{
    protected function grid()
    {
          Insertledger::insertNetIncome();

        $allexpenses=Balancesheet::where("year_id",getfinancilyear())->where($this->wherecon())->where("account_type_id",4)->get();
        $sumofexpenses=0;
        $headers = ['Id', 'Expense Accounts', 'Amount'];
       $rows=array();
       $id=1;
       foreach($allexpenses as $item){
           $rows[]=array($id,$this->getAccountname($item->account_id),$item->amount);
       $sumofexpenses+=$item->amount;
           $id++;
       }
      
       $sumofreveneues=0;
      $revenueAccounts= Balancesheet::where("year_id",getfinancilyear())->where($this->wherecon())->where("account_type_id",3)->get();

       $table = new Table($headers, $rows);
        $headers2 = ['Id', 'Reveneue Accounts', 'Amount'];
       $rows2=array();
       $id=1;
       foreach($revenueAccounts as $item){
           $rows2[]=array($id,$this->getAccountname($item->account_id),$item->amount);
       $sumofreveneues+=$item->amount;
           $id++;
       }
       

       $table2 = new Table($headers2, $rows2);
       
           
      return $table2->render().$table->render().$this->bottomhtml($sumofexpenses, $sumofreveneues);
    }

    private function getAccountname($id){
      if(DB::table("company_charts")->where("id",$id)->first()!=null)  
      return DB::table("company_charts")->where("id",$id)->first()->name;
      return "";
    }
    
    private function bottomhtml($sumofexpenses,$sumofreveneues){
        
      $html=  '<div class="callout callout-info">
        <h4>Net Income!</h4>
       NetIncome:'.($sumofreveneues-$sumofexpenses).'
      </div>';
      return $html;
    }
    
}
