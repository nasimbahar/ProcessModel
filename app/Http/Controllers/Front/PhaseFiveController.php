<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;

class PhaseFiveController extends Controller
{
    public function index(){
        $isphasefour=true;
        $header=__("front.phasefour");
        $subheader=__("front.subheaderphasefour");

        return view("front.phasefive",["header"=>$header,"subheader"=>$subheader,'isphasefour'=>$isphasefour]);
    }
}
