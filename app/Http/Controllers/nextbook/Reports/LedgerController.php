<?php
namespace App\Http\Controllers\nextbook\Reports;
use App\Models\nextbook\Ledgers;
use App\Models\nextbook\Companycharts;
use Encore\Admin\Show;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use App\Helpers\nextbook\Insertledger;
class LedgerController extends AdminController
{
     protected function grid()
    {
        Insertledger::insertledgerr();
        $grid = new Grid(new Ledgers);
        $grid->model()->where("year_id",getfinancilyear())->where($this->wherecon())->orWhere("company_id",0);
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->id('ID');
        $grid->currency()->currency_name(__("report.currencyname"));
        $grid->accountype()->name(__("report.accountname"));
        $grid->debit(__("report.debit"));
        $grid->credit(__("report.credit"));
        $grid->changeamount(__("report.changefromprviousyear"));
        return $grid;
    }
  
}
