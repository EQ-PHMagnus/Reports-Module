<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bet;
use App\Models\PrototypeData;
use App\Http\Traits\Chartist;
use App\Http\Traits\Reports;

class ReportsController extends Controller
{
    use Chartist, Reports;

    public function totalBets(Request $request){
        try{
           
            if(request()->ajax()){
                $result = $this->getBets($request,null); 
                return response()->json($result);
            }
            // export file
            $export = $request->input('export',false);
            if($export === 'true'){
                $exportQuery    = $this->getBets($request,'excel');
                $exportFileName = '_Bets_Reports.xlsx';
                return exportFiles($exportQuery,$exportFileName);
            }
            // render components
            return view('reports.bets.index');
        }catch(\Exception $e){
            dd($e);
            return $e->getMessage();
        }
    }

    public function totalFights(Request $request){
        try{
            if(request()->ajax()){
                $result = $this->getFights($request,null); 
                return response()->json($result);
            }
             // export file
             $export = $request->input('export',false);
             if($export === 'true'){
                $exportQuery    = $this->getFights($request,'excel');
                $exportFileName = '_Fights_Reports.xlsx';
                return exportFiles($exportQuery,$exportFileName);
             }
            // render components
            return view('reports.fights.index');
        }catch(\Exception $e){
            dd($e);
            return $e->getMessage();
        }
    }
}