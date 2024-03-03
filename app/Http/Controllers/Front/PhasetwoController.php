<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\Platforms;
use Illuminate\Http\Request;

class PhasetwoController extends Controller
{
    public function index(){
        $isphasetwo=true;
        $header=__("front.phasetwo");
        $subheader=__("front.subheaderphasetwo");
        $link=__("front.phasetwo");
        return view("front.phasetwo",["header"=>$header,"subheader"=>$subheader,"link"=>$link,'isphasetwo'=>$isphasetwo]);
    }
    public function store(Request $request){
        $isphasetwo=true;
        $header=__("front.phasetwo");
        $subheader=__("front.subheaderphasetwo");
        $link=__("front.phasetwo");
        $data=  $request->all();
        if(false) {
            $records = Platforms::orhas("platformconsense", function (Builder $query, $data) {
                $query->wherein('consensusmechanisms.id', '=', $data['platformconsenseids']);
            })
                ->orhas("platformlanguages", function (Builder $query, $data) {
                    $query->wherein('programminglanguages.id', '=', $data['platformlanguagesids']);
                })
                ->orhas("platformresliance", function (Builder $query, $data) {
                    $query->wherein('resiliencetypes.id', '=', $data['platformreslianceids']);
                })
                ->orhas("platformscalibilty", function (Builder $query, $data) {
                    $query->wherein('scalabilitytypes.id', '=', $data['platformscalibiltyids']);
                })
                ->orhas("platformlayers", function (Builder $query, $data) {
                    $query->wherein('layersupports.id', '=', $data['platformlayersids']);
                })->orhas("platforminteropability", function (Builder $query, $data) {
                    $query->wherein('interoperabilitytypes.id', '=', $data['platforminteropabilityids']);
                })
                ->orhas("platformprvaciy", function (Builder $query, $data) {
                    $query->wherein('privacytypes.id', '=', $data['platformprvaciyids']);
                })
                ->orhas("platformcontract", function (Builder $query, $data) {
                    $query->wherein('contractsupports.id', '=', $data['platformcontractids']);
                })
                ->orhas("platformdomain", function (Builder $query, $data) {
                    $query->wherein('domains.id', '=', $data['platformdomainids']);
                })
                ->orwhere('transactionspeed', '=', $data['transactionspeed'])
                ->orwhere('community', '=', $data['community'])
                ->orwhere('transactionspeed', '=', $data['transactionspeed'])
                ->orwhere('popularity', '=', $data['popularity'])->get();
        }

        return view("front.phasetwo",["header"=>$header,"ispost"=>true,"subheader"=>$subheader,"link"=>$link,'isphasetwo'=>$isphasetwo]);
    }


}
