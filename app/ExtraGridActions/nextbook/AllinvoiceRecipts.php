<?php

namespace App\ExtraGridActions\nextbook;


use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\nextbook\Expenses;
use App\Models\nextbook\Expensepayments;
use Encore\Admin\Facades\Admin;
 use Illuminate\Http\Request;

class AllinvoiceRecipts extends RowAction
{
    public $name ;
    public $id;
    function __construct($id=0) {
        parent::__construct();
        $this->name=__("invoice.seeallrecipts");
        $this->id=$id;
    }

    public function handle(Model $model, Request $request)
    {
       
    }
  public function href()
    {
        return admin_url("nextbook/invoicepayment",$this->id);
    }
}