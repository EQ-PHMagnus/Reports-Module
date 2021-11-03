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

    public function bets(Request $request,$type){
        try{
            if($type == 'total-amount-bets-arena' || $type == 'total-count-bets-arena'){
                $result = $this->getArena($request,$type,null); 
            }else{
                $result = $this->getBets($request,null); 
            }
            if(request()->ajax()){
                return response()->json($result);
            }
            // export file
            $export = $request->input('export',false);
            if($export === 'true'){
                if($type == 'total-amount-bets-arena' || $type == 'total-count-bets-arena'){
                    $exportQuery    = $this->getArena($request,null,'excel');
                    $exportFileName = '_Bets_Arena_Reports.xlsx';
                }else{
                    $exportQuery    = $this->getBets($request,'excel');
                $exportFileName = '_Bets_Reports.xlsx';
                }
                return exportFiles($exportQuery,$exportFileName);
            }
            // render components
            $data['type'] = 'count';
            if(str_contains($type,'amount') == true){
                $data['type'] = 'sum';
            }
            if($type == 'total-amount-bets-arena' || $type == 'total-count-bets-arena'){
                return view('reports.arena.index',compact('data'));
            }
            return view('reports.bets.index',compact('data'));
        }catch(\Exception $e){
            dd($e);
            return $e->getMessage();
        }
    }

    public function fights(Request $request,$type){
        try{
            if(request()->ajax()){
                if($type == 'total-amount-fights-arena' || $type == 'total-count-fights-arena'){
                    $result = $this->getArena($request,$type,null); 
                    return response()->json($result);
                }else{
                    $result = $this->getFights($request,null); 
                    return response()->json($result);
                }
            }
             // export file
             $export = $request->input('export',false);
             if($export === 'true'){
                if($type == 'total-amount-fights-arena' || $type == 'total-count-fights-arena'){
                    $exportQuery    = $this->getArena($request,null,'excel');
                    $exportFileName = '_Fights_Arena_Reports.xlsx';
                }else{    
                    $exportQuery    = $this->getFights($request,'excel');
                    $exportFileName = '_Fights_Reports.xlsx';
                }
                return exportFiles($exportQuery,$exportFileName);
             }
            // render components
            $data['type'] = 'count';
            if(str_contains($type,'amount') == true){
                $data['type'] = 'sum';
            }
            if($type == 'total-amount-fights-arena' || $type == 'total-count-fights-arena'){
                return view('reports.arena.index',compact('data'));
            }
            return view('reports.fights.index',compact('data'));
        }catch(\Exception $e){
            dd($e);
            return $e->getMessage();
        }
    }
}