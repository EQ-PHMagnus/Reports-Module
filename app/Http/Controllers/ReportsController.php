<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bet;
use App\Models\PrototypeData;
use App\Http\Traits\Chartist;
use App\Http\Traits\Bets;

class ReportsController extends Controller
{
    use Chartist, Bets;

    public function index(Request $request,$type){
        try{
            if(request()->ajax()){
                if($type == 'total-amount-bets-arena' || $type == 'total-count-bets-arena'){
                    $result = $this->getBetsArena($request,$type); 
                    return response()->json($result);
                }else{
                    $result = $this->getBets($request,$type); 
                    return response()->json($result);
                }
            }
            // render components
            $data = config('constants.menu.bets')[$type];
            if($type == 'total-amount-bets-arena' || $type == 'total-count-bets-arena'){
                return view('reports.bets-arena.index',compact('data'));
            }
            return view('reports.bets.index',compact('data'));
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}