<?php

namespace App\Helpers\nextbook\projects;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Encore\Admin\Grid;

class InvoiceTab 
{
    

    /**
     * Build a form here.
     */
    public static function tab($project_id)
    {
          
         $grid = new Grid(new \App\Models\nextbook\Invoice);
         $grid->model()->where("project_id",$project_id);
         $grid->actions(function ($actions) {
         $actions->disableView();
         
         });
             $grid->disableActions();
        $grid->disableCreateButton();
       $grid->customer()->name(__("invoice.customer_id"));
         $grid->accountype()->name(__("invoice.account_type_id"));
         $grid->total(__("invoice.total"));
         $grid->balance(__("invoice.balance"));
         $grid->paid(__("invoice.paid"));
         $grid->date(__("invoice.date"));

        return $grid->render();
       
        
        
    }

   
}
