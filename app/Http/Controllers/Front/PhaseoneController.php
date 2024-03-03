<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;

class PhaseoneController extends Controller
{


    public function index(){
        $isphaseone=true;
        $header=__("front.phaseone");
        $subheader=__("front.subheaderphaseone");
        $link=__("front.phaseone");
        return view("front.phaseone",["header"=>$header,"subheader"=>$subheader,"link"=>$link,'isphaseone'=>$isphaseone]);
    }


}
