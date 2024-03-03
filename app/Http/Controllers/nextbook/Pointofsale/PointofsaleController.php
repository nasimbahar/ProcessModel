<?php

namespace App\Http\Controllers\nextbook\Pointofsale;
use App\Models\nextbook\Products;
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
use Encore\Admin\Layout\Column;

use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;


class PointofsaleController extends AdminController
{
   
     public function loadpointofsale(Content $content)
    {

       return $content
            ->title(__("pointofsale.title"))
                ->row(function (Row $row){
                $row->column(8, function (Column $column) {
                           $autcompletJavascript=new \App\Http\Controllers\Ajax\nextbook\AutocompleteController();

                  $form=new \Encore\Admin\Widgets\Form1();
                  $form->disableCreatingCheck();
                  $form->disableSubmit();
                  $form->disableReset();
                  $form->text("search"," ")->attribute(array("placeholder"=>__("pointofsale.placeholder"),'class'=>"form-control autocomplete"))->icon("fa fa-search");
$form->html("<div id='autocompletelist' style='padding-left:150px;margin-top:0px;'></div>",'');
                  $column->append($form->render().$form->html($autcompletJavascript->Javascript("products", "name","true"))->render());
                });
                $row->column(4, function (Column $column) {
                   $view= view('pointofsell.sell');
                     $column->append($view->render());
                    
                });
                })->row(function (Row $row) {
     $row->column(8, function (Column $column) {
    $grid=$this->products();
    $column->append($grid);
});
            
    });
    }

    
    public function products(Request $request=null)
    {
      $query="dsfsdfsdfsdfsdfsdfsdfsdfsdfasdfasfdasdfsdf";
      if($request!=null){
      if($request->get('query'))
     {
      $query = $request->get('query');
     }
      }
      $grid = new Grid(new Products);
      $grid->disableTools();
      $grid->disableExport();
      $grid->disableActions();
      $grid->disablePagination();
      $grid->disableCreateButton();
      $grid->disableFilter();
      $grid->disableRowSelector();
      $grid->disableColumnSelector();
      $grid->model()->where($this->wherecon())->where("name",$query);
      $grid->id('ID');
      $grid->name(__('product.name'));
      $grid->code(__('product.code'));
      $grid->price(__('product.price'));
     $grid->quantity(__('product.quantity'));
        
        return $grid->render();

        
        
    }

    protected function form()
    {
      
       $form = new Form(new Products);
        $form->setWidth(10, 6);
        $form->column(1/2, function ($form) {
        $form->select("company_chart_id",__('product.accounttype'))->options(\App\Models\nextbook\Accounttypes::dropdown())->value(request('company_chart_id'));
        $form->text("name",__('product.name'));
        $form->image("logo",__('product.logo'));
        $form->text("code",__('product.code'))->icon("fa-barcode");
        $form->select("type",__('product.serveicetype'))->options(array("Inventory"=>"Inventory","Non Inventory"=>"Non Inventory","Services"=>"Services"))->value(request('type'));
         $form->text("quantity","product.quantity");
        $form->switch("transfer",__('product.transfer'))->attribute("style","width:50%");
        });
          $form->column(1/2, function ($form) {
         $form->select("currency_id",__('product.currency'))->options(Companycurrency::dropdown())->value(request('currency_id'));
          $form->number("cost",__('product.cost'))->attribute("style","width:100%");
          $form->number("price",__('product.price'))->attribute("style","width:100%");
          $form->date("purchase_date",__('product.purchasedate'))->attribute("style","width:50%");
          $form->date("expire",__('product.exprie'))->attribute("style","width:50%");
          $form->switch("notifaction",__('product.notifaction'))->attribute("style","width:50%");

        $form->submitted(function (Form $form) {
         $form->ignore('transfer');
        });

     
        $form->hidden("company_id")->default($this->companyid());
        $form->hidden("user_id")->default($this->userid());
          });
         
     
        

        return $form;
                
    }
    
    
    
    
   
}
