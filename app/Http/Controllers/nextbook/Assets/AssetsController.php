<?php

namespace App\Http\Controllers\nextbook\Assets;
use App\Models\nextbook\Assets;
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


class AssetsController  extends AdminController
{
   
     protected function grid()
    {
        $grid = new Grid(new Assets);
        $grid->model()->where($this->wherecon());
        $grid->id('ID');
        $grid->accountype()->name(__("assets.asset_type_id"));
         $grid->item_name(__("assets.item_name"));
         $grid->date(__("assets.date"));
        
        return $grid;
    }

    
    protected function detail($id)
    {
        
return $id;
        
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

    protected function form()
    {
      
        $form = new Form(new Assets);
                $form->setWidth(6);

        $form->text("item_name",__('assets.item_name'));

       
$form->select('currency_id',__("invoice.currency_id"))
        ->options(\App\Models\nextbook\Companycurrency::dropdown())->rules("required")->when(3, function (Form $form) {
          $form->select("asset_type_id",__('assets.asset_type_id'))->options(Companycharts::companyassetsaccount(3))->rules("required")->value(request('asset_type_id'));
        
           $form->select("credit_type_id",__("assets.credit_type_id"))->options(Companycharts::cashaccounts(3))->rules("required");
    })->when(144, function (Form $form) {
           $form->select("asset_type_id",__('assets.asset_type_id'))->options(Companycharts::companyassetsaccount(144))->rules("required")->value(request('asset_type_id'));
        
           $form->select("credit_type_id",__("assets.credit_type_id"))->options(Companycharts::cashaccounts(144))->rules("required");
    });
       $form->date("date",__("assets.date"));
       $form->text("serial_no",__('assets.serial_no'));
        $form->text("price",__('assets.price'));
      $form->select("project_id",__("assets.project_id"))->options(\App\Models\nextbook\Projects::dropdown())->value(request('project_id'));

        $form->textarea("description",__('assets.description'));
         $form->hidden("company_id")->default($this->companyid());
           $form->hidden("user_id")->default($this->userid());
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
       $record= \App\Models\nextbook\Assets::where("id",$id)->get()->first();
       if($record!=null){
          $Journaltransections=new \App\Helpers\nextbook\Journaltransections();
          $Journaltransections->debit_account_id=$record->asset_type_id;
          $Journaltransections->debit_amount=$record->price;
          $Journaltransections->credit_account_id=$record->credit_type_id;
          $Journaltransections->credit_amount=$record->price;
          $Journaltransections->currency_id=$record->currency_id;
          
          $Journaltransections->record_id=$id;
          $Journaltransections->module_id= \App\Helpers\nextbook\Allmodules::Assets;
          $Journaltransections->compnay_id=$this->companyid();
          $Journaltransections->project_id=$record->project_id;
          $Journaltransections->description=$record->description;
          $Journaltransections->note=$record->description;
          if($type=="insert"){
          $Journaltransections->insert();
          }
          else{
              $Journaltransections->update();
          }
       }
   }   
    
    
    
   
}
