<?php

namespace App\Http\Controllers\nextbook\Settings;
use App\Models\nextbook\Currency;
use App\Models\nextbook\Companycurrency;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
class ComapanycurrencyController extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Companycurrency);
       $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
         $actions->disableView();
       });
        $grid->id('ID');
        $grid->currency()->currency_name(__('settings.currencyname'));
        $grid->currency_type(__('settings.currencytype'));
        $this->title=__('settings.configruecurrecny');
         if($this->isfirstlogin()){
              $grid->footer(function ($query) {
                   $form=new \Encore\Admin\Widgets\Form1();
                    $form->disableSubmit();
                    $form->disableReset();
                    $html1="<a href=".admin_url('/')."><button style='float:left' class='btn btn-info'>".__('admin.prev')."</button></a>";
                    $html="<a href=".admin_url('nextbook/companyunits')."><button style='float:right' class='btn btn-info'>".__('admin.next')."</button></a>";
                    $form->html($html1.$html);
                   return $form->render();
          });
         }
        return $grid;
    }

    protected function form()
    {
       
        $form = new Form(new Companycurrency);
        $form->select("currency_id",__('settings.currency'))->options(Currency::dropdown())->rules( ['required',new \App\Rules\Unique("company_currency")])->value(request('currency_id'));
        $form->select("currency_type",__('settings.currencytype'))->options(["Base"=>"Base","Others"=>"Others"])->rules(['required',new \App\Rules\Currencycheak(request('currency_id'))])->value(request('currency_type'));
        $form->hidden("company_id")->default($this->companyid());
        return $form;
    }
   
}
