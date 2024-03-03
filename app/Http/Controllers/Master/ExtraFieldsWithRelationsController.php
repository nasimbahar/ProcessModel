<?php


namespace App\Http\Controllers\Master;


use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class ExtraFieldsWithRelationsController extends AdminController
{

    public function handle(Request $request){
        return redirect(admin_url("school/student"));
    }
}