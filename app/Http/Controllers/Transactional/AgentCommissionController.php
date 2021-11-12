<?php

namespace App\Http\Controllers\Transactional;

use Illuminate\Http\Request;
use App\Models\AgentCommission;
use App\Http\Traits\TransactionalData;

class AgentCommissionController extends Controller
{
    use TransactionalData;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getAgentCommisions(Request $request)
    {
        $type = explode("?", $request->type)[0];

        if(request()->ajax()){
            $result = $this->getTransactions($request, null, $type);
            return response()->json($result);
        }
        // export file
        $export = $request->input('export',false);
        if($export === 'true'){
            $exportQuery    = $this->getTransactions($request, 'excel', $type);
            $exportFileName = config('constants.menu.transactional-agent-commissions')[$type]['export_filename'] ?? '';
            return exportFiles($exportQuery,$exportFileName);
        }

        // render components
        $data = config('constants.menu.transactional-agent-commissions')[$type];

        return view('transactional.agent-commissions.index',compact('data'));
    }
}
