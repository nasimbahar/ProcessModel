<?php

namespace App\Http\Controllers\nextbook\Invoices;
use App\Models\nextbook\Invoicepayments;
use App\Models\nextbook\Projectstatus;
use App\Models\nextbook\Customers;
use App\Models\nextbook\Companycurrency;
use Encore\Admin\Show;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Customviews\Teeth;
use App\Models\Dentalchart;
use Illuminate\Support\Facades\DB;
use Encore\LodpodEditor\LodpodEditorTemplate;


class InvoicepaymentController extends AdminController
{
   
     protected function grid()
    {
        $grid = new Grid(new Invoicepayments);
        $grid->model()->where("invoice_id",$this->childid);
        $grid->actions(function($actions){
            $actions->disableEdit();
             $actions->disableView();
        });
        $grid->amount(__("invoice.amount"));
        $grid->balance(__("invoice.balance"));
        $grid->date(__("invoice.date"));
        $grid->user()->username(__("invoice.username"));

        return $grid;
    }

    
    protected function detail($id)
    {
        

        
         $tab = new \Encore\Admin\Widgets\Tab();
         $tab->add('Deliverables', \App\Helpers\nextbook\projects\DeliverablesTab::tab($id));
         $tab->add('Invioce and Payment', \App\Helpers\nextbook\projects\DeliverablesTab::tab($id));
         $tab->add('Expenses', \App\Helpers\nextbook\projects\DeliverablesTab::tab($id));
         $tab->add('Task and Progress', \App\Helpers\nextbook\projects\DeliverablesTab::tab($id));
  
        $show = new Show(Projects::findOrFail($id));
        $show->id('ID');
        $show->name('name'); 
        $show->panel()
      ->tools(function ($tools) {
        $tools->append('<a class="btn btn-primary btn-sm" id="print"><i class="fa fa-print"></i>print</a>');
     });
        
        return $show->render().$tab->render();
    }

    public function form()
    {
       //return response($this->childid);
        $form = new Form(new Invoicepayments);
       if(request('invoice_id')!=null){
          
                $this->childid= request('invoice_id');
       }
            
       $record=  \Illuminate\Support\Facades\DB::table("invoice")->where("id",$this->childid)->first();
      
       $form->hidden("invoice_id")->default($this->childid);
        
    $form->text("total",__("invoice.total"))->default($record->total)->readonly();
    $form->select("capital_account_id",__('invoice.capital_account_id'))->options(\App\Models\nextbook\Capitalaccounts::dropdown())->value(request('capital_account_id'));
    $form->text("balance",__("invoice.balance"))->default($record->balance)->readonly();
    $form->text("amount",__("invoice.paid"));
    $form->ignore("total");

    $form->textarea('description', __('invoice.description'))->rules('required');
    $form->hidden("user_id")->value($this->userid());
     $form->saving(function (Form $form) {
          $form->balance = $form->balance-$form->amount;
     });
     $form->saved(function (Form $form) {
        $oldpaid= \App\Models\nextbook\Invoice::where('id',$this->childid)->first()->paid;
       $balance= \App\Models\nextbook\Invoice::where('id',$this->childid)->first()->balance;
       $paid= request('amount');


       \Illuminate\Support\Facades\DB::table("invoice")->where("id",$this->childid)->update(array("balance"=>$balance-$paid,'paid'=>$oldpaid+$paid));
       });
    return $form;
    }
   
    
    

    
    
    
   
}
