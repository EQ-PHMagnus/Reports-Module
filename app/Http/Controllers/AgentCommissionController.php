<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgentCommission;
use App\Http\Traits\AgentCommissions;

class AgentCommissionController extends Controller
{
    use AgentCommissions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function super_agent(Request $request)
    {
        $type = 'super_agent';
        if(request()->ajax()){
            $result = $this->getAgentCommissions($request,$type,null); 
            return response()->json($result);
        }
        // export file
        $export = $request->input('export',false);
        if($export === 'true'){
            $exportQuery    = $this->getAgentCommissions($request,$type,'excel');
            $exportFileName = '_Super_Agent_Commissions_Reports.xlsx';
            return exportFiles($exportQuery,$exportFileName);
        }
        // render components
        $data = config('constants.menu.agent-commissions')[$type];
        return view('agent-commissions.index',compact('data'));
    }

    public function agent(Request $request)
    {
        $type = 'agent';
        if(request()->ajax()){
            $result = $this->getAgentCommissions($request,$type,null); 
            return response()->json($result);
        }
        // export file
        $export = $request->input('export',false);
        if($export === 'true'){
            $exportQuery    = $this->getAgentCommissions($request,$type,'excel');
            $exportFileName = '_Agent_Commissions_Reports.xlsx';
            return exportFiles($exportQuery,$exportFileName);
        }
        // render components
        $data = config('constants.menu.agent-commissions')[$type];
        return view('agent-commissions.index',compact('data'));
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
        //
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
