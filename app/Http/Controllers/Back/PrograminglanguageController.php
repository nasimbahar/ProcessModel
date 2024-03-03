<?php


namespace App\Http\Controllers\Back;


use App\Models\ConsensusMechanisms;
use App\Models\Programminglanguages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class PrograminglanguageController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Programminglanguages());
        $grid->id('ID');
        $grid->name(__('back.name'));
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Programminglanguages());
        $form->text("name",__('back.name'))->rules('required');
        $form->textarea("definition",__('back.definition'));
        $form->hidden("user_id")->value($this->userid());
        return $form;
    }
}
