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
            if(request()->ajax()){
                if($type == 'total-amount-bets-arena' || $type == 'total-count-bets-arena'){
                    $result = $this->getArena($request,$type); 
                    return response()->json($result);
                }else{
                    $result = $this->getBets($request); 
                    return response()->json($result);
                }
            }
            // render components
            $data = config('constants.menu.bets')[$type];
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
                    $result = $this->getArena($request,$type); 
                    return response()->json($result);
                }else{
                    $result = $this->getFights($request); 
                    return response()->json($result);
                }
            }
            // render components
            $data = config('constants.menu.fights')[$type];
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