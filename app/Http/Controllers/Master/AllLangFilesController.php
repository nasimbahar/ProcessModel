<?php


namespace App\Http\Controllers\Master;


use App\ExtraGridActions\LinkGridAction;
use App\Models\AllTableSettings;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;

class AllLangFilesController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new AllTableSettings);

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
            $allcolumns=$actions->row;

            $actions->add(new LinkGridAction( 'view',"langstring,".$allcolumns['lang_file'].",class","admin"));
        });
        $grid->model()->distinct()->select("lang_file");
        $grid->lang_file("Lang File");
        $grid->model()->groupBy("lang_file");

        return $grid;
    }
}
