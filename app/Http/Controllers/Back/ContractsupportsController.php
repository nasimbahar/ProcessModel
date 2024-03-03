<?php


namespace App\Http\Controllers\Back;


use App\Models\Contractsupports;
use App\Models\Interoperabilitytypes;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class ContractsupportsController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Contractsupports());
        $grid->id('ID');
        $grid->name(__('back.name'));
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Contractsupports());
        $form->text("name",__('back.name'))->rules('required');
        $form->textarea("definition",__('back.definition'));
        $form->hidden("user_id")->value($this->userid());
        return $form;
    }
}
