<?php

namespace App\Http\Controllers\Transactional;

use App\Models\Bet;
use Illuminate\Http\Request;
use App\Http\Requests\BetRequest;
use App\Http\Traits\TransactionalData;

use DB;

class BetController extends Controller
{
    use TransactionalData;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(request()->ajax()){

            $result = $this->getBets($request,null); 
            // $result = Bet::with(['arena','fight','fight.arena','affiliate'])
            // ->orderByDesc('created_at')
            // ->paginate(10)
            // ->withQueryString();
            
            return response()->json($result);
        }

        // export file
        $export = $request->input('export',false);
        if($export === 'true'){
            $exportQuery    = $this->getBets($request,'excel');
            $exportFileName = '_Bets_Reports.xlsx';
            return exportFiles($exportQuery,$exportFileName);
        }
        
        return view('transactional.bets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function show(Bet $bet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function edit(Bet $bet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function update(BetRequest $request, Bet $bet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bet $bet)
    {
        //
    }
}
