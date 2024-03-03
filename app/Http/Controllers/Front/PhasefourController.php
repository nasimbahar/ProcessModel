<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhasefourController extends Controller
{
    public function index(){

        $isphasefour=true;
        $header=__("front.phasefour");
        $subheader=__("front.subheaderphasefour");
        $price=0;
        $array=array("numContracts"=>0,"numTransactions"=>0,"avgPayloadSizeBytes"=>0,"period"=>0,"period_type"=>0);

        return view("front.phasefour",["header"=>"Phase Four","subheader"=>"Cost Estimation",'isphasefour'=>$isphasefour,"price"=>$price,"data"=>$array]);
    }

     public function store(Request $request){

         $numContracts=$request->get("numContracts");
         $numTransactions=$request->get("numTransactions");
         $avgPayloadSizeBytes=$request->get("avgPayloadSizeBytes");
         $period=$request->get("period");
         $gasPriceGwei=$this->getGasEstimate();;
         $etherToUsdRate=3000;
         $array=array("numContracts"=>$numContracts,"numTransactions"=>$numTransactions,"avgPayloadSizeBytes"=>$avgPayloadSizeBytes,"period"=>$period,"period_type"=>0);

        $price=  $this->estimateEthereumCost($numContracts,$numTransactions,$avgPayloadSizeBytes,$gasPriceGwei,$etherToUsdRate);
         $isphasefour=true;
         $header=__("front.phasefour");
         $subheader=__("front.subheaderphasefour");


         return view("front.phasefour",["header"=>"Phase Four","subheader"=>"Cost Estimation",'isphasefour'=>$isphasefour,"price"=>$price,'data'=>$array]);

    }

    function estimateEthereumCost($numContracts, $numTransactions, $avgPayloadSizeBytes, $gasPriceGwei, $etherToUsdRate) {
        // Constants from the description
        $C_address = 32000; // Gas for generating a new address for the smart contract
        $C_tx = 21000; // Gas for adding a new transaction to a block
        $C_storage_per_kb = 640000; // Gas for 1 kilobyte of storage
        $C_pload = ($avgPayloadSizeBytes / 1024) * $C_storage_per_kb;
        $C_fndef = 50000; // Example cost for function's definition
        $C_fnexec = 50000; // Example cost for extra gas during function execution
        $C_deploy = $C_tx + $C_address + $C_pload + $C_fndef;
        $C_coordmsg = $C_tx + $C_pload + $C_fnexec;
        $C_cost_in_gas = $numContracts * $C_deploy + $numTransactions * $C_coordmsg;
        $totalCostInEther = $C_cost_in_gas * $gasPriceGwei * pow(10, -9);
        $totalCostInUsd = $totalCostInEther * $etherToUsdRate;

        return $totalCostInUsd;
    }

    function getGasEstimate() {
        // Etherscan API endpoint
        $url = "https://api.etherscan.io/api";

        // Setting up query parameters
        $queryParams = http_build_query([
            "module" => "gastracker",
            "action" => "gasoracle",
            "apikey" => "QQ4XCZ8FHA6EAWSZ3E3XGMIFAPMPICNXVX"
        ]);


        // Initialize curl session
        $ch = curl_init();

        // Set curl options
        curl_setopt($ch, CURLOPT_URL, $url . '?' . $queryParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the curl session
        $response = curl_exec($ch);
        $decodedResponse = json_decode($response, true);

        // Check if the response is valid and contains 'FastGasPrice'
        if (is_array($decodedResponse) && isset($decodedResponse['result']['FastGasPrice'])) {
            return $decodedResponse['result']['FastGasPrice'];
        } else {
            return 29;
        }

        // Close curl session
        curl_close($ch);

        // Return the response

    }

// Usage


}
