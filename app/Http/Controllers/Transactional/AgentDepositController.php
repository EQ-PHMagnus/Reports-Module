<?php

namespace App\Http\Controllers\Transactional;

use Illuminate\Http\Request;
use App\Models\AgentDeposit;
use App\Http\Traits\MasterAgentDeposits;

class AgentDepositController extends Controller
{
    use MasterAgentDeposits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $type = explode("?", $request->type)[0];
        
        if(request()->ajax()){
            $result = $this->getMasterAgentDeposits($request, null, $type);

            return response()->json($result);
        }
        // export file
        $export = $request->input('export',false);
        if($export === 'true'){
            $exportQuery    = $this->getMasterAgentDeposits($request, 'excel', null);
            $exportFileName = config('constants.menu.transactional-agent-deposits')[$type]['export_filename'] ?? '';
            return exportFiles($exportQuery,$exportFileName);
        }

        // render components
        $data = config('constants.menu.transactional-agent-deposits')[$type];

        return view('transactional.agent-deposits.index',compact('data'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{  
            AgentDeposit::find($id)->update(['status' => config('defaults.agent_deposit_status')[$request->type]]);
        }catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
