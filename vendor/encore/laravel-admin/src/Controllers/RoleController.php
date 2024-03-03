<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\nextbook\Allmodules;

class RoleController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    protected function title()
    {
        return trans('admin.roles');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $roleModel = config('admin.database.roles_model');

        $grid = new Grid(new $roleModel());

        $grid->column('id', 'ID')->sortable();
         $grid->model()->where('school_id',0)->where("id",">",2)->orWhere("school_id",$this->school_id());

        $grid->column('slug', trans('admin.slug'));
        $grid->column('name', trans('admin.name'));

        $grid->column('permissions', trans('admin.permission'))->pluck('name')->label();

        $grid->column('created_at', trans('admin.created_at'));
        $grid->column('updated_at', trans('admin.updated_at'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->row->slug == 'administrator') {
                $actions->disableDelete();
            }
        });

        $grid->tools(function (Grid\Tools $tools) {
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        $roleModel = config('admin.database.roles_model');

        $show = new Show($roleModel::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('slug', trans('admin.slug'));
        $show->field('name', trans('admin.name'));
        $show->field('permissions', trans('admin.permissions'))->as(function ($permission) {
            return $permission->pluck('name');
        })->label();
        $show->field('created_at', trans('admin.created_at'));
        $show->field('updated_at', trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
         $id=array(0);
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');
        $form = new Form(new $roleModel());
        $form->display('id', 'ID');
        $form->text('slug', trans('admin.slug'))->rules('required');
        $form->text('name', trans('admin.name'))->rules('required');
       $allmodule= Allmodules::all();
       foreach($allmodule as $item){
        $form->listbox('permissions', $item->name)->options($permissionModel::where(array('school_id'=>1,"module_id"=>$item->id))->whereNotIn("id",$id)->orWhere("school_id",$this->school_id())->pluck('name', 'id'));
       }
        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));
        $form->hidden("school_id")->default($this->school_id());


        return $form;
    }
    
    function saveallfunction(){
       $allmodule= Allmodules::all(); 
       $creatstring="Create of ";
       $insertstring="Save of";
       $editstring="Edit of ";
       $updatestring="Update of ";
       $liststring=" View list of ";
       $showstring=" View One record of ";
       $deletestring= "Delete-of-";
        $creatstringslug="Create-of-";
       $insertstringslug="Save-of-";
       $editstringslug="Edit-of-";
       $updatestringslug="Update-of-";
       $liststringslug=" View-list-of-";
       $showstringslug=" View-One-record-of-";
       $deletestringslug= "Delete-of-";
       $creatmethod="GET,HEAD";
      
       $insertmethod="POST";
       $showmethod="GET,HEAD";
       $listmethod="GET,HEAD";
       $editmethod="GET,HEAD";
       $updatemethod="PUT,PATCH";
       $deletemethod="DELETE";
        foreach($allmodule as $item){
            DB::insert('insert into admin_permissions (module_id, name, slug, http_method, http_path, company_id) values ('.$item->id.',)');
        }
    }
    function allroutes(){
        
    }
}
