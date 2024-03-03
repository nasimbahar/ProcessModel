<?php

namespace App\Http\Controllers\nextbook\Expenses;
use App\Models\nextbook\Expensepayments;
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


class ExpensepaymentController extends AdminController
{
   
     protected function grid()
    {
        $grid = new Grid(new Expensepayments);
        $grid->model()->where("expense_id",$this->childid);
        $grid->actions(function($actions){
            $actions->disableEdit();
             $actions->disableView();
        });
        $grid->amount(__("expenses.amount"));
        $grid->balance(__("expenses.balance"));
        $grid->date(__("expenses.date"));
        $grid->user()->username(__("expenses.username"));

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
      
        $form = new Form(new Expensepayments);
        if($form->isCreating()){
       $record=  \Illuminate\Support\Facades\DB::table("expenses")->where("id",$this->childid)->first();
        }
        else{
        
                  $record=  \Illuminate\Support\Facades\DB::table("expenses")->where("id",$this->childid)->first();

        }
       $form->hidden("expense_id")->default($this->childid);
        
    $form->text("total",__("expenses.total"))->default($record->total)->readonly();
    $form->select("capital_account_id",__('expenses.capital_account_id'))->options(\App\Models\nextbook\Capitalaccounts::dropdown())->value(request('capital_account_id'));
    $form->text("balance",__("expenses.balance"))->default($record->balance)->readonly();
    $form->text("paid",__("expenses.paid"));


    $form->textarea('description', __('expenses.description'))->rules('required');   
    
    return $form;
    }
   
    
    

    
    
    
   
}
