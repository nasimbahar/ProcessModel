<?php

namespace App\Http\Controllers\nextbook\Accounts;
use App\Models\nextbook\Accountjournal;
use App\Models\nextbook\Companycurrency;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Show;
class JournaltransectionController  extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Accountjournal);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
        // $actions->disableView();
       });
         $grid->filter(function($filter){
          $filter->equal('currency_id',__("accounts.currency")) ->select(Companycurrency::dropdown());
        $filter->equal('project_id',__("accounts.project_id"))->select(\App\Models\nextbook\Projects::dropdown());

});
       $grid->date(__('accounts.date')); 
       $grid->project()->name(__("accounts.projectname"));
       $grid->currecny()->currency_name(__("accounts.currency"));
       $grid->column('Account Name')->display(function ( $column) {
        $draccount=Accountjournal::getAccountname($this->debit_account_id);
        $craccount=Accountjournal::getAccountname($this->credit_account_id);
        $payableaccount=Accountjournal::getAccountname($this->payable_account_id);
        $receviabeaccount=Accountjournal::getAccountname($this->receivable_account_id);
        $html="";
        
        if($draccount!=null){
            $html.=$draccount."<br><br>";
        }
         if($craccount!=null){
            $html.=$craccount."<br><br>";
     }
     
         if($payableaccount!=null){
            $html.=$payableaccount."<br><br>";
        }
         if($receviabeaccount!=null){
            $html.=$receviabeaccount."<br><br>";
        }
        return $html;
  
});
        $grid->column('Debit')->display(function ( $column) {
        $draccount=Accountjournal::getAccountname($this->debit_account_id);
        $craccount=Accountjournal::getAccountname($this->credit_account_id);
        $payableaccount=Accountjournal::getAccountname($this->payable_account_id);
        $receviabeaccount=Accountjournal::getAccountname($this->receivable_account_id);
        $html="";
         if($craccount!=null){
            $html.=$this->debit_amount."<br><br>";
        }
      if($draccount!=null){
            $html.="<br><br>";
        }
         if($receviabeaccount!=null){
            $html.=$this->receivable_amount."<br><br>";
        }
        return $html;
  
});

    
        $grid->column('Creadit')->display(function ( $column) {
        $draccount=Accountjournal::getAccountname($this->debit_account_id);
        $craccount=Accountjournal::getAccountname($this->credit_account_id);
        $payableaccount=Accountjournal::getAccountname($this->payable_account_id);
        $receviabeaccount=Accountjournal::getAccountname($this->receivable_account_id);
        
        $html="";
         
         if($draccount!=null){
            $html.="<br><br>";
        }
         
        
         if($craccount!=null){
            $html.=$this->credit_amount."<br><br>";
        }
          if($payableaccount!=null){
            $html.=$this->payable_amount."<br><br>";
        }
        
         if($receviabeaccount!=null){
            $html.="<br><br>";
        }
        
        return $html;
  
});
       
        return $grid;
    }
    protected function detail($id)
    {
         $show = new Show(Accountjournal::findOrFail($id));
         $show->panel()->istwocolumns("true");
         $show->panel()
      ->tools(function ($tools) {
        $tools->append('<a class="btn btn-primary btn-sm btn-print" id="printtt" onclick="printpage()"><i class="fa fa-print"></i>print</a>');
     });
        
        return $show->render();
    }
    protected function form()
    {
        $form = new Form(new Accountjournal);
        $form->setWidth(10, 6);
        $form->column(1/2, function ($form) {
        $form->textarea("description",__("accounts.description"))->rules('required');
           $form->select('project_id',__("accounts.project_id"))->options(\App\Models\nextbook\Projects::dropdown());

        $form->date("date",__("accounts.date"));
        $form->select("currency_id",__("accounts.currency"))->options(Companycurrency::dropdown())->value(request('currency_id'));
         });
           $form->column(1/2, function ($form) {
               $form->select("debit_account_id",__("accounts.debit_account_id"))->options(\App\Models\nextbook\Companycharts::dropdown());
               $form->text("debit_amount",__("accounts.debit_amount"))->icon("fa fa-money");
               $form->select("credit_account_id",__("accounts.credit_account_id"))->options(\App\Models\nextbook\Companycharts::dropdown());
               $form->text("credit_amount",__("accounts.credit_amount"))->icon("fa fa-money")->readonly();
              $form->textarea("note",__("accounts.note"))->rules('required');
              $form->html($this->javascript());

           });
          $form->saving (function (Form $form){
                 // $form->credit_amount=$form->debit_amount;
            });
         $form->hidden("user_id")->default($this->userid());          
         $form->hidden("company_id")->default($this->companyid());
         $form->hidden("year_id")->default(getfinancilyear());
        return $form;
    }

  private function javascript(){
        $js="<script type='text/javascript'>
                                $(document).ready(function () {
                                  
                                    $(document).on('keyup', '.debit_amount', function () {
                                    $('.credit_amount').val($(this).val());
                                     
});
                                });
                            </script>";
        return $js;
                
    }
    
    
    
    
   
}
