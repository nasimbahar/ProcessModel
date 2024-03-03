<?php

namespace App\Http\Controllers\nextbook\Settings;
use App\Models\nextbook\Currency;
use App\Models\nextbook\Currencyrates;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
class CurrencyrateController extends AdminController
{
   
     protected function grid()
    {
       $grid = new Grid(new Currencyrates);
       $grid->model()->where($this->wherecon());
      
       $grid->disableActions();
       $grid->disableCreateButton();
        $grid->id('ID');
        $grid->date(__("settings.date"));
        $grid->currency()->currency_name(__('settings.currencyname'));
        $grid->rate(__('settings.rate'))->editable();
        
        
        return $grid;
    }

  
   
}
