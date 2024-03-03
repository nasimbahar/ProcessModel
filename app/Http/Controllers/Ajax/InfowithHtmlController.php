<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Patients;
use Encore\Admin\Show;

class InfowithHtmlController extends Controller
{
    
 public function patientinfo(Request $request)
{
    $patientid = $request->get('id');
    $show = new Show(Patients::findOrFail($patientid));
     $show->panel()
    ->tools(function ($tools) {
        $tools->disableEdit();
        $tools->disableList();
        $tools->disableDelete();
    });;
        $show->fname('Father name'); 
        $show->contact_number('mobile_number'); 
        $show->picture('Picture')->image('',50,50);
        return $show;
 

}

 public function paymentinfo(Request $request)
{
     return "";
    $planid = $request->get('id');
    $show = new Show(\App\Models\Payments::where("treatmentplan_id",$planid));
     $show->panel()
    ->tools(function ($tools) {
        $tools->disableEdit();
        $tools->disableList();
        $tools->disableDelete();
    });;
       //$show->field("amount");
       // $show->amount('amount'); 
//        $show->contact_number('mobile_number'); 
//        $show->picture('Picture')->image('',50,50);
        return $show;
 

}
}
