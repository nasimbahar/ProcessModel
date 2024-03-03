<?php


namespace App\Http\Controllers\Back;


use App\Models\ConsensusMechanisms;
use App\Models\nextbook\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class ConsensusMechanismsController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new ConsensusMechanisms());
        $grid->id('ID');
        $grid->name(__('back.name'));
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new ConsensusMechanisms());
        $form->text("name",__('back.name'))->rules('required');
        $form->textarea("definition",__('back.definition'));
        $form->hidden("user_id")->value($this->userid());
        return $form;
    }
}
