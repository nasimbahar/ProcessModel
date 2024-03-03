<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;

class PhasethreeController extends Controller
{
    public function index(){
        $isphasethree=true;
        $header=__("front.phasethree");
        $subheader=__("front.subheaderphasethree");

        return view("front.phasethree",["header"=>$header,"subheader"=>$subheader,'isphasethree'=>$isphasethree]);
    }
}
