<?php

namespace App\Http\Controllers\nextbook\Invoices;
use App\Models\nextbook\Invoice;
use App\Models\nextbook\Projectstatus;
use App\Models\nextbook\Customers;
use App\Models\nextbook\Companycurrency;
use App\Models\nextbook\Companycharts;
use App\Models\nextbook\Products;
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
use App\ExtraGridActions\nextbook\Invoicepayment;



class InvoiceController extends AdminController
{
   
     protected function grid()
    {
        $grid = new Grid(new Invoice);
        $grid->model()->where($this->wherecon());
        $grid->customer()->name(__("invoice.customer_id"));
         $grid->accountype()->name(__("invoice.account_type_id"));
         $grid->total(__("invoice.total"));
         $grid->balance(__("invoice.balance"));
         $grid->paid(__("invoice.paid"));
         $grid->date(__("invoice.date"));
         $grid->actions(function ($actions) {
         $balance=Db::table("invoice")->where('id',$actions->getkey())->first()->balance;
       if($balance>0){
    $actions->add(new Invoicepayment($actions->getkey()));
       }
    $actions->add(new \App\ExtraGridActions\nextbook\AllinvoiceRecipts($actions->getkey()));
                
                           
                        }
                    
                );
        return $grid;
    }

    
    protected function detail($id)
    {
        

    
         $tab = new \Encore\Admin\Widgets\Tab();
         $tab->add(__('invoice.invoicedetials'), \App\Helpers\nextbook\invoice\InvoiceDetialsTab::tab($id));
        
  
        $show = new Show(Invoice::findOrFail($id));
        $show->panel()->istwocolumns("true");
                $show->invoice_no(__("invoice.invoice_no"))->istable("true");

        $show->description(__("invoice.description"))->istable("true");
        $show->date(__("invoice.date"))->istable("true");
        $show->payment_type(__("invoice.payment_type"))->istable("true");
          $show->customer_id(__('invoice.customer_id'))->as(function ($id) {
            return \App\Models\nextbook\Customers::getname($id);
        })->badge()->istable("true");
         $show->project_id(__('invoice.project_id'))->as(function ($id) {
            return \App\Models\nextbook\Projects::getname($id);
        })->badge()->istable("true");
         $show->total(__("invoice.total"))->istable("true");
         $show->balance(__("invoice.balance"))->istable("true");
         $show->paid(__("invoice.paid"))->istable("true");
                  $show->due_date(__("invoice.duedate"))->istable("true");


         $show->currency_id(__('invoice.currency_id'))->as(function ($id) {
            return \App\Models\nextbook\Currency::getname($id);
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
      $product=new Products();
        $form = new Form(new Invoice);
        $autcompletJavascript=new \App\Http\Controllers\Ajax\nextbook\AutocompleteController();
        $form->setWidth(10, 6);
        $form->column(1/3, function ($form) {
        $form->select('currency_id',__("invoice.currency_id"))
        ->options(\App\Models\nextbook\Companycurrency::dropdown())->rules("required")->when(3, function (Form $form) {
           $form->select("account_type_id",__('invoice.account_type_id'))->options(Companycharts::companyrevenueaccounts(3))->rules("required")->value(request('account_type_id'));
           $form->select("debit_type_id",__("invoice.debit_type_id"))->options(Companycharts::cashaccounts(3))->rules("required");
       })->when(144, function (Form $form) {
           $form->select("account_type_id",__('invoice.account_type_id'))->options(Companycharts::companyrevenueaccounts(144))->rules("required")->value(request('account_type_id'));
           $form->select("debit_type_id",__("invoice.debit_type_id"))->options(Companycharts::cashaccounts(144))->rules("required");
       });
       $form->select("invoice_type",__('invoice.invoice_type'))->options(array("Direct Sale Invoice"=>"Direct Sale Invoice","Due Date Invoice"=>"Due Date Invoice"))->rules("required")->value(request('invoice_type'));
        $form->select("payment_type",__('invoice.payment_type'))->options(array("Cash"=>"Cash","Bank"=>"Bank","Cheque"=>"Cheque","Other"=>"Other"))->rules("required")->value(request('payment_type'));
        $form->select("customer_id",__('quotation.customer_id'))->options(Customers::dropdown())->rules("required")->value(request('customer_id'));
         });
          $form->column(1/3, function ($form) {
           $form->select('project_id',__("invoice.project_id"))->options(\App\Models\nextbook\Projects::dropdown());
          $form->select("discount",__('invoice.discount'))->options(Invoice::percentage())->value(request('discount'));

//           $form->select("currency_id",__("invoice.currency_id"))->options(\App\Models\nextbook\Companycurrency::dropdown())->rules("required")->value(request('currency_id'));
           $form->date("date",__('invoice.date'))->rules("required");
          

        
           $form->column(1/3, function ($form) {
           $form->select("store_id",__('invoice.store_id'))->options(\App\Models\nextbook\Storehouse::dropdown())->value(request('store_id'));
           $form->text("invoice_no",__('invoice.invoice_no'))->default("INV-");
           $form->date("duedate",__('invoice.duedate'));
            $form->hasMany("attachements",__("invoice.attachments"), function (Form\NestedForm $form) {
            $form->textarea("description",__("invoice.description"));
            $form->file("file",__("invoice.file"));
            $form->hidden("company_id")->default($this->companyid());
             $form->hidden("user_id")->default($this->userid());
        });
        });
        
          });
          if($product->ishasproduct()){
           $form->column(12,function($form){
           $form->hasMany('invoicedetials',__('invoice.invoicedetials'), function (Form\NestedForm $form) {
           $form->select("product_id",__("invoice.product_id"))->options(\App\Models\nextbook\Products::dropdown())->attribute("class","form-control product_id");
          // $form->text('product',__("invoice.product_id"))->attribute("class",'form-control invoicedetials autocomplete');
        //  $form->html("<div id='autocompletelist'></div>",'');

          $form->text("description",__('invoice.description'));
 
          $form->number("price",__('invoice.price'))->attribute("class","form-control price");
          $form->number("quantity",__('invoice.quantity'));
          $form->text("amount",__('invoice.amount'))->readonly()->attribute("class","form-control rowamount");
          $form->hidden("user_id")->default($this->userid());
         // $form->hidden("currency_id")->default(request("currency_id"));
          $form->hidden("user_id")->default($this->userid());
          })->mode("table");
            
          });
          }
          if($form->isCreating()){
          $form->column(1/3,function($form){
         $form->text("total",__('invoice.total'))->icon("fa fa-dollar")->readonly()->attribute("id","alltotal");
          });
           $form->column(1/3,function($form){
            $form->text("paid",__('invoice.paid'))->default('0');
          });
           $form->column(1/3,function($form){
         $form->text("balance",__('invoice.balance'))->readonly();
          });
          }
           $form->column(12,function($form){
           $form->textarea("memo",__("invoice.memo"));
           $form->html($this->javascript());});
          // $form->html($autcompletJavascript->Javascript("products", "name"));
           $form->hidden("company_id")->default($this->companyid());
           $form->hidden("user_id")->default($this->userid());
           
        if($form->isCreating()){
            
           $form->saved(function (Form $form) {
                if($form->paid>0){
                $invoiceid=$form->model()->id;
                $invocie_payment=new \App\Models\nextbook\Invoicepayments();
                $invocie_payment->invoice_id=$invoiceid;
                $invocie_payment->amount=$form->paid;
                $invocie_payment->date=$form->date;
                $invocie_payment->balance=$form->balance;
                $invocie_payment->debit_type_id=$form->debit_type_id;
                $invocie_payment->user_id=$this->userid();
                $invocie_payment->save();
                $this->journaltransection($invoiceid, "insert");
                $this->updateproductnames($invoiceid);
                }
                
            });
        
       }
            return $form;
    }
    private function journaltransection($id,$type){
       $record= \App\Models\nextbook\Invoice::where("id",$id)->get()->first();
       if($record!=null){
          $Journaltransections=new \App\Helpers\nextbook\Journaltransections();
          $Journaltransections->debit_account_id=$record->debit_type_id;
          $Journaltransections->debit_amount=$record->paid;
          $Journaltransections->credit_account_id=$record->account_type_id;
          $Journaltransections->credit_amount=$record->total;
          $Journaltransections->currency_id=$record->currency_id;
          if($record->balance!=0){
          $Journaltransections->receivable_account_id= getRecvibaleAccount($record->currency_id);
          $Journaltransections->receivable_amount=$record->balance;
          }
          $Journaltransections->record_id=$id;
          $Journaltransections->module_id= \App\Helpers\nextbook\Allmodules::Invoices;
          $Journaltransections->compnay_id=$this->companyid();
          $Journaltransections->project_id=$record->project_id;
          $Journaltransections->description=$record->memo;
          $Journaltransections->note=$record->memo;
          $Journaltransections->insert();
          
       }
   }
    
    
    private function javascript(){
        $js="<script type='text/javascript'>
          
                                $(document).ready(function () {
                                $(document).on('change', '.product_id', function () { 
                                var id =this.value;
                                $.ajax({
          url:'".admin_url()."/nextbook/getprice',
          method:'get',
         data: { id: id } ,
          success:function(data){
         
                    $('input.price').val(data);

          }
         });
                                });
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
                                           
                                             $('#alltotal').val(sum);
                                           $('.balance').val( $('#alltotal').val()- $('.paid').val());

                                        }
                                        else {
                                            $(this).closest('tr').find('input.amount').val('');
                                        }
                                        
                             
                                    });
                                    $(document).on('keyup', '.paid', function () {
                                     $('.balance').val( $('#alltotal').val()- $('.paid').val());
                                     
});
    
                                });
                            
                            </script>";
        return $js;
                
    }
    
    
   private function updateproductnames($id){
       $invoicedetials= DB::table("invoice_details")->where("invoice_id",$id)->get();
       foreach($invoicedetials as $item){
          $data=array("product"=>$this->getproducetname($item->product_id));
          DB::table("invoice_details")->where("id",$item->id)->update($data);
       }
       
   } 
   public function getproducetname($id){
        if(DB::table("products")->where("id",$id)->first()!=null)  
      return DB::table("products")->where("id",$id)->first()->name;
      return "";
   }
      public function getprice(Request $request){
          $id=$request->get("id");
        if(DB::table("products")->where("id",$id)->first()!=null)  
      return DB::table("products")->where("id",$id)->first()->price;
      return "";
   }
   
}
