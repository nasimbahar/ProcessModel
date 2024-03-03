<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{

    public function index(){

        $header=__("front.welcome");
        $subheader=__("front.home");
        $link=__("front.welcome");
        return view("front.welcome",["header"=>$header,"subheader"=>$subheader,"link"=>$link]);
    }

}
