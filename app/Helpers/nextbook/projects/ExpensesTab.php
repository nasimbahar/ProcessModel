<?php

namespace App\Helpers\nextbook\projects;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Encore\Admin\Grid;

class ExpensesTab 
{
    public static  $projectid;

    public static function tab($project_id)
    {
          ExpensesTab::$projectid=$project_id;
         $grid = new Grid(new \App\Models\nextbook\Expenses);
         $grid->model()->where("project_id",$project_id);
         $grid->actions(function ($actions) {
         $actions->disableView();
         
         });
         $grid->disableActions();
        $grid->disableCreateButton();
        $grid->description(__("expenses.description"));
        $grid->total(__("expenses.total"));
        $grid->balance(__("expenses.balance"));
        $grid->paid(__("expenses.paid"));
        $grid->paid_to(__("expenses.paid_to"));
        $grid->date(__("expenses.date"));
        $grid->project()->name(__("expenses.project_id"));
          $grid->footer(function ($query) {

    // Query the total amount of the order with the paid status
      $total = $query->where('project_id', ExpensesTab::$projectid)->sum('total');
      $balance = $query->where('project_id', ExpensesTab::$projectid)->sum('balance');
      $paid = $query->where('project_id', ExpensesTab::$projectid)->sum('paid');
   return table_footer(__("expenses.total"), $total).table_footer(__("expenses.balance"), $balance).table_footer(__("expenses.paid"), $paid);;
});
     
        return $grid->render();
       
        
        
    }

   
}
