<?php


namespace App\Http\Controllers\Master;


use App\Models\Allpapers;
use App\Models\nextbook\Employee;
use App\Models\PhdModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Form;
use Encore\Admin\Show;

class AllpapersController extends AdminController
{

    protected function grid()
    {
        $grid = new Grid(new Allpapers());

       // $grid->id('ID');
        $grid->title("Title");

        $grid->year()->name("Year");
        $grid->type()->name("Paper Type");
        $grid->id("File")->display(function ($name) {
            //$path=asset("/uploads/".$name);
           $url= admin_url("phd/getfile/".$name);
            return "<a href='".$url."' target='_blank'>Read</a>" ;
         // return  "<iframe src='".$path."' style='width:100%;height:100px;'></iframe>";
           // return "<object data='".$path."' type=\"application/pdf\" width=\"300\" height=\"200\"><a href='".$path."' >Read</a> </object>";
        });
        $grid->filter(function($filter){
             $filter->disableIdFilter();
             $filter->equal("year_id","Year")->select(PhdModel::dropdown("years"));
             $filter->equal("type_id","Paper Type")->select(PhdModel::dropdown("papertypes"));
             $filter->contains('authors', 'Authors');
             $filter->equal('isread')->radio([
               ''   => 'All',
               0    => 'Not read',
               1    => 'Read',
           ]);



        });

        return $grid;
    }
    public function getfile($id){
        $file=Allpapers::where("id",$id)->get()->first();
        $path=asset("/uploads/".$file->file);
       return "<object data='".$path."' type=\"application/pdf\" width=\"100%\" height=\"700\"></object>";
    }
    protected function form()
    {
        $form = new Form(new Allpapers());
        $form->textarea('title', 'Title')->rules('required');
        $form->select("year_id","Year")->options(PhdModel::dropdown("years"));
        $form->select("type_id","Types")->options(PhdModel::dropdown("papertypes"));
        $form->summernote('authors', 'Authors')->rules('required');
        $form->summernote('background', 'Background');
        $form->textarea('researchproblems', 'Research Problem');
        $form->textarea('researchquestions', 'Research Questions');
        $form->textarea('objectives', 'Objectives ');
        $form->textarea('solution', 'Solution');
        $form->textarea('dataset', 'Data Set Used?');
        $form->textarea('limitions', 'Limitions');
        $form->textarea('algorithems', 'Algorithms');
        $form->textarea('toolsandtechniques', 'Tools and Technique');
        $form->file("file","Attachment");
        $form->switch("isread","Is read?");

        return $form;
    }
    protected function detail($id)
    {

        $show = new Show(Allpapers::findOrFail($id));

        $show->title('Title');
        $show->background('Background');
        $show->researchproblems('Research Problem');
        $show->researchquestions('Research Questions');
        $show->limitions('Limitions');
        $show->objectives('Objectives');
        $show->solution('Solution');
        $show->dataset('Data Set');
        $show->algorithems('Algorithems');
        $show->toolsandtechniques('Tools and Techniques');



        return $show;
    }
}
