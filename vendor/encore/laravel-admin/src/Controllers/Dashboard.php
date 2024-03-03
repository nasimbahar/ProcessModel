<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Dashboard
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function title()
    {
       // return view('admin::dashboard.title');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function first()
    {

     $chart=new \App\Charts\Pie();
     $chart->title="Patients Percentage based on Procedures";
     $allprocedure= \App\Models\Procedures::all();
     foreach($allprocedure as $one){
         $sum= \App\Models\Treatmentplan::where("procedure_id",$one->id)->sum("procedure_id");
        $chart->points[$one->name]=$sum;
     }

     $chart->type="patients";
        return view('admin::dashboard.1',compact('chart'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function second()
    {
        return "second";
       $chart=new \App\Charts\Line();
     $chart->title="Income based on Year and Procedure Type";
      $chart->subTitle="All Income ";
      $chart->yaxixTitle="Income";
      $chart->pointstart=2010;

     $allprocedure= \App\Models\Procedures::all();


        return view('admin::dashboard.2',compact('chart'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function third()
    {

return  "Third";
        return view('admin::dashboard.3');
    }
    public static function fourth(){
         return view('admin::dashboard.4');
    }
     public static function wherecon(){
        return array('school_id'=>Admin::user()->school_id);
    }
}
