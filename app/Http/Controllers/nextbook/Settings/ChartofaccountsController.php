<?php

namespace App\Http\Controllers\nextbook\Settings;
use App\Models\nextbook\Companycharts;
use App\Models\nextbook\Accounttypes;
use App\Models\nextbook\Currency;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
class ChartofaccountsController  extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Companycharts);
       $grid->model()->where($this->wherecon())->orWhere('company_id',0);
       $grid->actions(function ($actions) {
         $actions->disableView();
         $actions->disableDelete();
       });
        $grid->disableActions();
        $grid->id('ID');
        $grid->name(__('settings.accountchartname'));
        $grid->accountype()->name(__('settings.accounttype'));
        $grid->currency()->currency_name(__('settings.currencyname'));

        $this->title=__('settings.accountcharttitle');
        if($this->isfirstlogin()){
             $grid->footer(function ($query) {

                   $form=new \Encore\Admin\Widgets\Form1();
                    $form->disableSubmit();
                    $form->disableReset();
                    $html1="<a href=".admin_url('nextbook/companyunits')."><button style='float:left' class='btn btn-info'>".__('admin.prev')."</button></a>";

                    $html="<a href='' onclick='loadstart()'><button style='float:right' class='btn btn-info'>".__('admin.start')."</button></a>";
                    $form->html($html1.$html);
                    return $form->render();
           });
         }
        return $grid;
       
    }

    protected function form()
    {
        $form = new Form(new Companycharts);
        $form->text("name",__("settings.accountchartname"))->rules('required');
        $form->select("account_type_id",__('settings.accounttype'))->options(Accounttypes::dropdown())->rules( ['required'])->value(request('account_type_id'));
        $form->select("currency_id",__('settings.currency'))->options(Currency::dropdown())->rules('required')->value(request('currency_id'));

        $form->hidden("company_id")->default($this->companyid());
        return $form;
    }

    public function start(){
        \Illuminate\Support\Facades\DB::table("admin_users")->where('id',Admin::user()->id)->update(array('is_first_login'=>0));
        return redirect(admin_url("/"));
    }
    

 
    
    
    
    
   
}
