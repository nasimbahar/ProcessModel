<?php


namespace App\Http\Controllers\Master;


use App\ExtraGridActions\LinkGridAction;
use App\Models\AllTableSettings;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;

class LangStringsController   extends AdminController
{
    protected function grid($langfile)
{
    dd($langfile);
    $grid = new Grid(new AllTableSettings);

    $grid->actions(function ($actions) {
        $actions->disableView();
        $actions->disableEdit();
        $actions->disableDelete();
        $allcolumns=$actions->row;

        $actions->add(new LinkGridAction( $allcolumns['lang_file'],"school,school,lang","admin"));
    });
    $grid->model()->distinct()->select("lang_file");
    $grid->lang_file("Lang File");
    $grid->model()->groupBy("lang_file");

    return $grid;
}


}
