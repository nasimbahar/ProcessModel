<?php


namespace App\Http\Controllers\Back;


use App\Models\Phd;
use App\Models\Platforms;
use App\Models\PrivacyTypes;
use App\Models\Programminglanguages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class PlatformsController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Platforms());
        $grid->id('ID');
        $grid->name(__('back.name'));
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Platforms());
        $form->text("name",__('back.name'))->rules('required');
        $form->url("website",__('back.website'))->rules('required');
        $form->url("github",__('back.github'))->rules('required');
        $form->multipleSelect("platformconsense",__("back.platformconsense"))->options(Phd::dropdown("consensusmechanisms"));
        $form->multipleSelect("platformlanguages",__("back.platformlanguages"))->options(Phd::dropdown("programminglanguages"));
        $form->multipleSelect("platformresliance",__("back.platformresliance"))->options(Phd::dropdown("resiliencetypes"));
        $form->multipleSelect("platformscalibilty",__("back.platformscalibilty"))->options(Phd::dropdown("scalabilitytypes"));
        $form->multipleSelect("platformlayers",__("back.platformlayers"))->options(Phd::dropdown("layersupports"));
        $form->multipleSelect("platforminteropability",__("back.platforminteropability"))->options(Phd::dropdown("interoperabilitytypes"));
        $form->multipleSelect("platformprvaciy",__("back.platformprvaciy"))->options(Phd::dropdown("privacytypes"));
        $form->multipleSelect("platformtokens",__("back.platformtokens"))->options(Phd::dropdown("tokenssupports"));
        $form->multipleSelect("platformcontract",__("back.platformcontract"))->options(Phd::dropdown("contractsupports"));

        $form->hidden("user_id")->value($this->userid());
        return $form;
    }
}
