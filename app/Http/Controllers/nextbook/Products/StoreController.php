<?php

namespace App\Http\Controllers\nextbook\Products;
use App\Models\nextbook\Storehouse;
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


class StoreController  extends AdminController
{
   
     protected function grid()
    {
        $grid = new Grid(new Storehouse);
        $grid->model()->where($this->wherecon());
       $grid->actions(function ($actions) {
       $actions->disableView();
   });
        $grid->id('ID');
        $grid->name(__('product.storename'));
   
        $grid->type(__('product.storetype'))->label([
        'Real' => 'primary',
        'Virtual' => 'success',
        'Store' => 'warning',
         
      ]);
//           $grid->column('Status')->display(function ($progress, $column) {
//          if($this->sat)
//  
//});
         $grid->product_limit(__('product.product_limit'));
         $grid->quantity_limit(__('product.quantity_limit'));
        
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
      
        $form = new Form(new Storehouse);
        $form->setWidth(10, 6);
        $form->column(1/2, function ($form) {
         $form->text("name",__('product.storename'));

        $form->select("type",__('product.storetype'))->options(array("Real"=>"Real","Virtual"=>"Virtual","Store"=>"Store"))->value(request('type'));
        $form->text("product_limit",__('product.product_limit'));
        $form->text("quantity_limit",__('product.quantity_limit'));
        $form->date("date",__('product.createddate'));
      
        
       
      

     
        $form->hidden("company_id")->default($this->companyid());
        $form->hidden("user_id")->default($this->userid());
       
         
     
        

        
         });
        
         return $form;
    }
 

    
    
    
    
   
}
