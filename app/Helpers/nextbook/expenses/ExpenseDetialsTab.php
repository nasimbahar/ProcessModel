<?php

namespace App\Helpers\nextbook\expenses;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Encore\Admin\Grid;
use App\ExtraGridActions\nextbook\Delerables;

class ExpenseDetialsTab 
{
    public static $expense_id;

    /**
     * Build a form here.
     */
    public static function tab($expense_id)
    {
          ExpenseDetialsTab::$expense_id=$expense_id;
         $grid = new Grid(new \App\Models\nextbook\Expensesdetials);
                         $grid->filter(function($filter){

 

        $filter->equal('company_chart_id',__("expenses.company_chart_id"))->select(\App\Models\nextbook\Companycharts::companyexpenseaccount());

});
         $grid->model()->where("expense_id",$expense_id);
         $grid->actions(function ($actions) {
         $actions->disableView();
           $actions->disableEdit();
           $actions->disableDelete();
         });
        $grid->disableCreateButton();
        $grid->id('ID');
        $grid->bill_no(__("expenses.bill_no"));
        $grid->description(__("expenses.description"));
        $grid->quantity(__("expenses.quantity"));
       
        $grid->amount(__("expenses.price"));
       $grid->total(__("expenses.total"));
       $grid->chartofaccount()->name(__("expenses.company_chart_id"));
       $grid->disableActions();
       $grid->footer(function ($query) {

    // Query the total amount of the order with the paid status
      $total = $query->where('expense_id', ExpenseDetialsTab::$expense_id)->sum('total');
      $quantity = $query->where('expense_id', ExpenseDetialsTab::$expense_id)->sum('quantity');
    
   return table_footer(__("expenses.quantity"), $quantity).table_footer(__("expenses.total"), $total);
});
        return $grid->render();
       
        
        
    }

   
}
