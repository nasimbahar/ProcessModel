<?php

namespace App\Http\Controllers\nextbook\Accounts;
use App\Models\nextbook\Capitalaccounts;
use App\Models\nextbook\Companycurrency;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
class CaptialaccountsController  extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Capitalaccounts);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         $actions->disableView();
       });
        $grid->id('ID');
         $grid->name(__('accounts.accountname'));
         $grid->type(__('accounts.accounttype'));
         $grid->currecny()->currency_name(__("accounts.currency"));
         $grid->initial_capital(__('accounts.initial_capital'));
         $grid->balance(__('accounts.balance'));

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Capitalaccounts);
        $form->text("name",__("accounts.accountname"))->rules('required');
        $form->select("type",__('accounts.accounttype'))->options(array("Bank"=>"Bank","Cash"=>"Cash"))->rules( ['required'])->value(request('type'));
        $form->select("currency_id",__("accounts.currency"))->options(Companycurrency::dropdown())->value(request('currency_id'));
        $form->text("initial_capital",__("accounts.initial_capital"))->rules('required');
        $form->textarea("description",__("accounts.description"))->rules('required');
        $form->hidden("balance");
         if($form->isCreating()){
            $form->saving (function (Form $form){
                  $form->balance=$form->initial_capital;

            });
         }
         $form->hidden("user_id")->default($this->userid());          
        $form->hidden("company_id")->default($this->companyid());
        return $form;
    }

    public function start(){
        \Illuminate\Support\Facades\DB::table("admin_users")->where('id',Admin::user()->id)->update(array('is_first_login'=>0));
        return redirect(admin_url("/"));
    }
    

 
    
    
    
    
   
}
