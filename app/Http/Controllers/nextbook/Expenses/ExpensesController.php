<?php

namespace App\Http\Controllers\nextbook\Expenses;
use App\Models\nextbook\Expenses;
use App\Models\nextbook\Companycharts;
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
use App\ExtraGridActions\nextbook\Expesepayment;
use Encore\Admin\Actions\Action;


class ExpensesController  extends AdminController
{
   
     protected function grid()
    {
        $grid = new Grid(new Expenses);
                $grid->filter(function($filter){

 
    $filter->equal('date', __("expenses.date"));

        $filter->equal('project_id',__("expenses.project_id"))->select(\App\Models\nextbook\Projects::dropdown());

});
        $grid->model()->where($this->wherecon());
        $grid->id('ID');
        $grid->description(__("expenses.description"));
        $grid->total(__("expenses.total"));
        $grid->balance(__("expenses.balance"));
        $grid->paid(__("expenses.paid"));
        $grid->paid_to(__("expenses.paid_to"));
        $grid->date(__("expenses.date"));
        $grid->project()->name(__("expenses.project_id"));
        $grid->actions(function ($actions) {
        $actions->add(new Expesepayment($actions->getkey()));
        $actions->add(new \App\ExtraGridActions\nextbook\SeeAllRecipts($actions->getkey()));
                
                           
                        }
                    
                );
                $grid->footer(function ($query) {

  
      $total = $query->where('company_id', $this->companyid())->sum('total');
      $balance = $query->where('company_id', $this->companyid())->sum('balance');
      $paid = $query->where('company_id', $this->companyid())->sum('paid');
   return table_footer(__("expenses.total"), $total).table_footer(__("expenses.balance"), $balance).table_footer(__("expenses.paid"), $paid);;
});
        return $grid;
    }

    
    protected function detail($id)
    {
        

        
         $tab = new \Encore\Admin\Widgets\Tab();
         $tab->add('Expenses Detials', \App\Helpers\nextbook\expenses\ExpenseDetialsTab::tab($id));
        
  
        $show = new Show(Expenses::findOrFail($id));
        $show->panel()->istwocolumns("true");
        $show->description(__("expenses.description"))->istable("true");
        $show->date(__("expenses.date"))->istable("true");
        $show->paid_by(__("expenses.paid_by"))->istable("true");
        $show->paid_to(__("expenses.paid_to"))->istable("true");
         $show->project_id(__('expenses.project_id'))->as(function ($id) {
            return \App\Models\nextbook\Projects::getname($id);
        })->badge()->istable("true");
        $show->user_id(__('admin.username'))->as(function ($id) {
            return \App\User::getname($id);
        })->badge()->istable("true");
        
        $show->panel()
      ->tools(function ($tools) {
        $tools->append('<a class="btn btn-primary btn-sm btn-print" id="printtt" onclick="printpage()"><i class="fa fa-print"></i>print</a>');
     });
        
        return $show->render().$tab->render();
    }

    protected function form()
    {
      
        $form = new Form(new Expenses);
        $form->setWidth(10, 6);
        $form->column(1/2, function ($form) {
        $form->text("paid_by",__('expenses.paid_by'))->icon("fa fa-user");
        $form->text("paid_to",__('expenses.paid_to'))->icon("fa fa-user");
        $form->select('currency_id',__("invoice.currency_id"))
    ->options(\App\Models\nextbook\Companycurrency::dropdown())->rules("required")->when(3, function (Form $form) {
           $form->select("account_type_id",__("expenses.account_type_id"))->options(Companycharts::cashaccounts(3))->rules("required");
          $form->select("expense_account_type_id",__('expenses.expense_account_type_id'))->options(Companycharts::companyexpenseaccount(3))->rules("required")->value(request('expense_account_type_id'));
    })->when(144, function (Form $form) {
           $form->select("account_type_id",__("expenses.account_type_id"))->options(Companycharts::cashaccounts(144))->rules("required");
           $form->select("expense_account_type_id",__('expenses.expense_account_type_id'))->options(Companycharts::companyexpenseaccount(144))->rules("required")->value(request('expense_account_type_id'));
    });;
         });
           $form->column(1/2, function ($form) {
           $form->select("project_id",__("expenses.project_id"))->options(\App\Models\nextbook\Projects::dropdown())->value(request('project_id'));
           $form->text("description",__('expenses.description'))->icon("fa fa-info");
           $form->select("vendor_id",__("expenses.vendor_id"))->options(\App\Models\nextbook\Vendor::dropdown())->value(request('vendor_id'));
           $form->date("date",__("expenses.date"))->rules("required");
           $form->hasMany("attachements",__("expenses.attachments"), function (Form\NestedForm $form) {
           $form->textarea("description",__("expenses.description"));
           $form->file("file",__("expenses.file"));
           $form->hidden("company_id")->default($this->companyid());
           $form->hidden("user_id")->default($this->userid());
        });
          });
           $form->column(12,function($form){
          $form->hasMany('expensedetials',__('expenses.expensedetials'), function (Form\NestedForm $form) {
          $form->text("bill_no",__('expenses.bill_no'));

          $form->text("description",__('expenses.description'));
          $form->select("unit_id",__("expenses.unit"))->options(\App\Models\nextbook\Companyunits::dropdown())->value(request('currency_id'));
          $form->number("quantity",__('expenses.quantity'));
          $form->number("amount",__('expenses.amount'))->attribute("class","form-control oneamount");
          $form->number("total",__('expenses.total'))->readonly()->attribute("class","form-control rowamount");
          $form->hidden("user_id")->default($this->userid());
          })->mode("table");
            
          });
          if($form->isCreating()){
          $form->column(1/3,function($form){
         $form->text("total",__('expenses.total'))->icon("fa fa-dollar")->readonly()->attribute("id","alltotal");
          });
           $form->column(1/3,function($form){
            $form->text("paid",__('expenses.paid'))->default('0');
          });
           $form->column(1/3,function($form){
         $form->text("balance",__('expenses.balance'))->readonly();
          });
          }
           $form->column(12,function($form){
           $form->textarea("memo",__("expenses.memo"));
           $form->html($this->javascript());});
           $form->hidden("company_id")->default($this->companyid());
           $form->hidden("user_id")->default($this->userid());
      
            
           $form->saved(function (Form $form) {
                 if($form->isCreating()){
                if($form->paid>0){
                $expenseid=$form->model()->id;
                $expense_payment=new \App\Models\nextbook\Expensepayments();
                $expense_payment->expense_id=$expenseid;
                $expense_payment->amount=$form->paid;
                $expense_payment->date=$form->date;
                $expense_payment->balance=$form->balance;
                 $expense_payment->account_type_id=$form->account_type_id;
                $expense_payment->user_id=$this->userid();
                $expense_payment->save();
                $this->journaltransection($expenseid,"insert");
                }
                 }
                 
            });
        
       
      
            return $form;
    }
 
    
   private function journaltransection($id,$type){
       $record= \App\Models\nextbook\Expenses::where("id",$id)->get()->first();
       if($record!=null){
          $Journaltransections=new \App\Helpers\nextbook\Journaltransections();
          $Journaltransections->debit_account_id=$record->expense_account_type_id;
          $Journaltransections->debit_amount=$record->total;
          $Journaltransections->credit_account_id=$record->account_type_id;
          $Journaltransections->credit_amount=$record->paid;
          $Journaltransections->currency_id=$record->currency_id;
           if($record->balance!=0){
          $Journaltransections->payable_account_id= getPayableAccount($record->currency_id);
          $Journaltransections->payable_amount=$record->balance;
           }
          $Journaltransections->record_id=$id;
          $Journaltransections->module_id= \App\Helpers\nextbook\Allmodules::Expenses;
          $Journaltransections->compnay_id=$this->companyid();
          $Journaltransections->project_id=$record->project_id;
          $Journaltransections->description=$record->description;
          $Journaltransections->note=$record->memo;
          if($type=="insert"){
          $Journaltransections->insert();
          }
          else{
              $Journaltransections->update();
          }
       }
   }

        private function javascript(){
        $js="<script type='text/javascript'>
                                $(document).ready(function () {
                                    var id = 0;
                                    $(document).on('keyup', '.quantity,.oneamount', function () {
                                      var quantity = $(this).closest('tr').find('input.quantity').val();
                                        var oneamount = $(this).closest('tr').find('input.oneamount').val();
                                        if (oneamount != '' || quantity != '') {
                                            $(this).closest('tr').find('input.rowamount').val(oneamount * quantity);
                                            var inputs = $('.rowamount');
                                            var sum = 0;
                                            inputs.each(function () {
                                              if(Number($(this).val())!=0){
                                                sum += Number($(this).val());
                                                }
                                            });
                                           
                                            $('#alltotal').val(sum);
                                           $('.balance').val( $('#alltotal').val()- $('.paid').val());

                                        }
                                        else {
                                            $(this).closest('tr').find('input.oneamount').val('');
                                        }
                                    });
                                     $(document).on('keyup', '.paid', function () {
                                     $('.balance').val( $('#alltotal').val()- $('.paid').val());
                                     
});
                                });
                            </script>";
        return $js;
                
    }

    public function expensepayment($id){
        return $id;
    }
    
    
    
   
}
