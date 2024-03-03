<?php

namespace App\Http\Controllers\nextbook\Qoutation;
use App\Models\nextbook\Quotations;
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


class QuotationController extends AdminController
{
   
     protected function grid()
    {
        $grid = new Grid(new Quotations);
        $grid->model()->where($this->wherecon());
//         $grid->actions(function ($actions) {
//          $actions->disableView();
//        });
        $grid->id('ID');
        $grid->date(__('quotation.date'));
        $grid->customer()->name(__('quotation.customer_id'));
     
        $grid->period(__('quotation.period'));
        $grid->periodtype(__('quotation.periodtype'));
         
//        $grid->fname('Father Name');
//        $grid->contact_number('Mobile');
//        $grid->picture('Picture')->image('',50,50);
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

    protected function form()
    {
      
        $form = new Form(new Quotations);
        $form->setWidth(10, 6);
        
        $form->column(1/2, function ($form) {
    
        $form->select("customer_id",__('quotation.customer_id'))->options(Customers::dropdown())->value(request('customer_id'));
        $form->date("date",__('quotation.date'));
        });
          $form->column(1/2, function ($form) {
          $form->text("period",__("quotation.period"));
          $form->select("periodtype",__("quotation.periodtype"))->options(array("Day"=>"Day","Month"=>"Month","Year"=>"Year"))->value(request('periodtype'));
          $form->hasMany("attachements",__("quotation.attachments"), function (Form\NestedForm $form) {
            $form->textarea("description",__("quotation.description"));
            $form->file("file",__("quotation.file"));
            $form->hidden("company_id")->default($this->companyid());
        });
        $form->hidden("company_id")->default($this->companyid());
        $form->hidden("user_id")->default($this->userid());
          });
          $form->column(12,function($form){
          $form->hasMany('quotationsdetials',__('quotation.quotationsdetials'), function (Form\NestedForm $form) {
         $form->select("product_id",__("quotation.product_id"))->options(\App\Models\nextbook\Products::dropdown())->value(request('product_id'));
         $form->text("description",__('quotation.description'));
 
          $form->number("price",__('quotation.price'));
          $form->number("quantity",__('quotation.quantity'));
          $form->text("amount",__('quotation.amount'))->readonly()->attribute("class","form-control rowamount");
          $form->hidden("user_id")->default($this->userid());
         // $form->hidden("currency_id")->default(request("currency_id"));
           // $form->hidden("currency_id")->default(request("currency_id"));
          })->mode("table");
            
          });
         
         $form->html($this->javascript());


        return $form;
    }
    public function editt($id,$delverable){
        return "hello";
    }
    
    
    private function javascript(){
        $js="<script type='text/javascript'>
                                $(document).ready(function () {
                                    var id = 0;
                                    $(document).on('keyup', '.quantity,.price', function () {
                                      var quantity = $(this).closest('tr').find('input.quantity').val();
                                        var price = $(this).closest('tr').find('input.price').val();
                                        if (price != '' || quantity != '') {
                                            $(this).closest('tr').find('input.rowamount').val(price * quantity);
                                            var inputs = $('.rowamount');
                                            var sum = 0;
                                            inputs.each(function () {
                                              if(Number($(this).val())!=0){
                                                sum += Number($(this).val());
                                                }
                                            });
                                           
                                            $('#projectamount').val(sum);
                                        }
                                        else {
                                            $(this).closest('tr').find('input.amount').val('');
                                        }
                                    });
                                });
                            </script>";
        return $js;
                
    }
    
    
    
    
   
}
