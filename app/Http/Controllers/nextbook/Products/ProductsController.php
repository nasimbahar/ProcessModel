<?php

namespace App\Http\Controllers\nextbook\Products;
use App\Models\nextbook\Products;
use App\Models\nextbook\Projectstatus;
use App\Models\nextbook\Companycharts;
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


class ProductsController  extends AdminController
{
   
     protected function grid()
    {
        $grid = new Grid(new Products);
        $grid->model()->where($this->wherecon());
        $grid->actions(function ($actions) {
        //$actions->disableView();
   });
        $grid->id('ID');
        $grid->name(__('product.name'));
        $grid->code(__('product.code'));
        $grid->type(__('product.type'))->label([
        'Inventory' => 'primary',
        'Services' => 'success',
        'Non Inventory' => 'warning',
      ]);

         $grid->price(__('product.price'));
         $grid->quantity(__('product.quantity'));
        
        return $grid;
    }

    
    protected function detail($id)
    {
         $show = new Show(Products::findOrFail($id));
         $show->panel()->istwocolumns("true");
         $show->panel()
      ->tools(function ($tools) {
        $tools->append('<a class="btn btn-primary btn-sm btn-print" id="printtt" onclick="printpage()"><i class="fa fa-print"></i>print</a>');
     });
        
        return $show->render();
    }

    protected function form()
    {
        $form = new Form(new Products);
        $form->setWidth(10, 6);
        $form->column(1/2, function ($form) {
        $form->select('currency_id',__("invoice.currency_id"))
        ->options(\App\Models\nextbook\Companycurrency::dropdown())->rules("required")->when(3, function (Form $form) {
          $form->select("company_chart_id",__('assets.asset_type_id'))->options(Companycharts::companyinventoryaccount(3))->rules("required")->value(request('company_chart_id'));
          $form->select("credit_account_id",__("assets.credit_type_id"))->options(Companycharts::cashaccounts(3))->rules("required");
    })->when(144, function (Form $form) {
           $form->select("company_chart_id",__('assets.asset_type_id'))->options(Companycharts::companyinventoryaccount(144))->rules("required")->value(request('company_chart_id'));
           $form->select("credit_type_id",__("assets.credit_type_id"))->options(Companycharts::cashaccounts(144))->rules("required");
    });
       if($form->isCreating()){
        $form->text("name",__('product.name'))->rules(['unique:products','required']);
       }
       else{
            $form->text("name",__('product.name'))->readonly();
       }
        $form->image("logo",__('product.logo'));
        $form->text("code",__('product.code'))->icon("fa-barcode");
        $form->select("type",__('product.serveicetype'))->options(array("Inventory"=>"Inventory","NonInventory"=>"Non Inventory","Services"=>"Services"))->rules("required")->when("Services", function (Form $form) {
            })->when("Inventory", function (Form $form) {
                  $form->text("quantity","product.quantity");
              })->when("NonInventory", function (Form $form) {
                  $form->text("quantity","product.quantity");
              });;
        
      
        });
          $form->column(1/2, function ($form) {
          $form->number("cost",__('product.cost'))->attribute("style","width:100%");
          $form->number("price",__('product.price'))->attribute("style","width:100%");
          $form->date("purchase_date",__('product.purchasedate'))->attribute("style","width:50%");
          $form->date("expire",__('product.exprie'))->attribute("style","width:50%");
          $form->select("store_id",__('product.store_id'))->options(\App\Models\nextbook\Storehouse::dropdown());
          $form->switch("notifaction",__('product.notifaction'))->attribute("style","width:50%");
          $form->submitted(function (Form $form) {
          $form->ignore('transfer');
        });
        $form->hidden("company_id")->default($this->companyid());
        $form->hidden("user_id")->default($this->userid());
          });
         
     $form->saved(function (Form $form) {
                $id=$form->model()->id;
                 if($form->isCreating()){
              $this->journaltransection($id,"insert");
                 }
                 else{
                    $this->journaltransection($id,"update");
                 }
                 
            });
        

        return $form;
    }
 
   private function journaltransection($id,$type){
       $record= \App\Models\nextbook\Products::where("id",$id)->get()->first();
       if($record!=null){
          $Journaltransections=new \App\Helpers\nextbook\Journaltransections();
          $Journaltransections->debit_account_id=$record->company_chart_id;
          $Journaltransections->debit_amount=$record->cost;
          $Journaltransections->credit_account_id=$record->credit_account_id;
          $Journaltransections->credit_amount=$record->cost;
          $Journaltransections->currency_id=$record->currency_id;
          $Journaltransections->record_id=$id;
          $Journaltransections->module_id= \App\Helpers\nextbook\Allmodules::Product;
          $Journaltransections->compnay_id=$this->companyid();
          $Journaltransections->description=$record->name;
          $Journaltransections->note=$record->name;
          if($type=="insert"){
          $Journaltransections->insert();
          }
          else{
              $Journaltransections->update();
          }
       }
   }   
    
    
    
    
    
   
}
