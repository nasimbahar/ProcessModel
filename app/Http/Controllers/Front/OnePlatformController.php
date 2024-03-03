<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;

class OnePlatformController extends Controller
{
    public function index(){
        $isphasetwo=true;
        $header=__("front.phasetwo");
        $subheader=__("front.subheaderphasetwo");
        return view("front.oneplatform",["header"=>$header,"subheader"=>$subheader,'isphasetwo'=>$isphasetwo]);
    }

}
