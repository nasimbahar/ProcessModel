<?php

namespace App\Helpers\nextbook\invoice;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Encore\Admin\Grid;
use App\ExtraGridActions\nextbook\Delerables;

class InvoiceDetialsTab 
{
    public static $invoice_id;

    /**
     * Build a form here.
     */
    public static function tab($invoice_id)
    {
          InvoiceDetialsTab::$invoice_id=$invoice_id;
         $grid = new Grid(new \App\Models\nextbook\Invoicedetials);
                         $grid->filter(function($filter){

 

        $filter->like('product',__("invoice.product_id"));

});
         $grid->model()->where("invoice_id",$invoice_id);
         $grid->actions(function ($actions) {
         $actions->disableView();
           $actions->disableEdit();
           $actions->disableDelete();
         });
        $grid->disableCreateButton();
        $grid->id('ID');
        $grid->product(__("invoice.product_id"));
        $grid->description(__("invoice.description"));
        $grid->quantity(__("invoice.quantity"));
       
        $grid->price(__("invoice.price"));
       $grid->amount(__("invoice.total"));
       $grid->disableActions();
       $grid->footer(function ($query) {

    // Query the total amount of the order with the paid status
      $total = $query->where('invoice_id', InvoiceDetialsTab::$invoice_id)->sum('amount');
      $quantity = $query->where('invoice_id', InvoiceDetialsTab::$invoice_id)->sum('quantity');
    
   return table_footer(__("invoice.quantity"), $quantity).table_footer(__("invoice.total"), $total);
});
        return $grid->render();
       
        
        
    }

   
}
