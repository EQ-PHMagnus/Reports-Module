<?php
namespace App\Http\Traits;
use DB;
use App\Models\Agent;

trait MasterAgentDeposits {
    

    public function getMasterAgentDeposits($request, $format, $roleType) {

        $sort           = request()->input('sort') == "" ? 'created_at' : request()->input('sort');
        $order          = request()->input('order', 'desc');
        $search         = request()->input('filters.search');
        $amount         = request()->input('filters.amount');
        $from           = date('Y-m-d h:i:s', strtotime($request->input('filters.from')));
        $to             = date('Y-m-d h:i:s', strtotime($request->input('filters.to'))) ?? $from;
        $stat           =  request()->input('filters.status');

        $searchable_cols = ['agent.name', 'ad.source'];

        $data   = DB::table('agent_deposits as ad')
                        ->leftJoin('agents as agent', 'agent.id', '=', 'ad.agent_id')
                        ->leftJoin('agents as superagent', 'superagent.id', '=', 'ad.super_agent_id')
                        ->selectRaw('agent.name as name,
                        agent.role as role,
                        ad.id,
                        ad.amount,
                        ad.source,
                        ad.source_details,
                        ad.date_approved,
                        ad.date_deposited,
                        ad.remarks,
                        ad.status,
                        superagent.name as agent_name')
                        ->when($search, function($query,$search){
                            return $query->where('name', 'like' ,'%'.$search.'%')
                            ->orWhere('source', 'like' ,'%'.$search.'%')
                            ->orWhere('source_details', 'like' ,'%'.$search.'%');
                        })
                        ->when($amount, function($query,$amount){
                            return $query->where('amount' , '<=' ,$amount);
                        })
                        // ->when($from, function ($query , $from) use ($to) {
                        //     return $query->whereBetween('ad.date_deposited', [$from, $to]);
                        // })
                        ->when($sort, function($query, $sort) use ($order){
                            return $query->orderBy('ad.'.$sort, $order);
                        })
                        ->when($stat, function($query,$stat){
                            return $query->where('status', $stat);
                        })
                        ->when($search, function($query, $search) use($searchable_cols) {
                            $query->where(function($query) use ($searchable_cols, $search){
                                foreach($searchable_cols as $i => $col){
                                    $query->orWhere($col, 'like' ,'%'.$search.'%');
                                }
                                return $query;
                              });
                            return $query;
                        })
                        ->where('status','!=', 'pending')
                        // ->whereNull('ad.deleted_at')
                        ;
        if($roleType == 'super_agent') {
            $data->whereNull('super_agent_id');
        } else {
            $data->whereNotNull('super_agent_id');
        }
     
        if($format == 'excel'){
            return $data->get();
        }

        $dataCount  = $data->count();
        $formData   = $data->skip(intval(request()->input('offset', 0)))
                            ->limit(intval(request()->input('limit', 10)))
                            ->get();

        $finalData  = [];
        $offset     = request()->input('offset', 0) + 1;
     

        foreach($formData as $i => $data){
            
            $action = '<button type="button" 
                        data-type="approved"
                        data-url="'.route('agent-deposits.update',$data->id).'" 
                        class="btn btn-icon btn-primary btn-outline btn-confirmation" data-toggle="tooltip" data-title="Approve this deposit">
                        <i class="icon wb-thumb-up" aria-hidden="true"></i> 
                    </button>
                    <button type="button" 
                            data-type="rejected"
                            data-url="'.route('agent-deposits.update',$data->id).'" 
                            class="btn btn-icon btn-danger btn-outline btn-confirmation" data-toggle="tooltip" data-title="Decline this deposit">
                            <i class="icon wb-thumb-down" aria-hidden="true"></i> 
                        </button>';

            if($data->status == 'approved'){
                $status = '<span class="badge badge-success">Approved</span>';
            }else if($data->status == 'rejected'){
                $status = '<span class="badge badge-danger">Rejected</span>';
            }else{
                $status = '<span class="badge badge-warning">Pending</span>';
            }

            $finalData[] = [
              
                'id'             => $offset++,
                'name'           => $data->name,
                'amount'         => $data->amount ? moneyFormat($data->amount): '',
                'source'         => $data->source,
                'source_details' => $data->source_details,
                'date_deposited' => date('m-d-Y',strtotime($data->date_deposited)),
                'date_approved'  => date('m-d-Y',strtotime($data->date_approved)),
                'status'         => $status,
                'action'         => $action,
                'agent_name'     => $data->agent_name ?? NULL
            ];
            
        }

        return [
        
            'rows'             => $finalData,
            'total'            => $dataCount,
            'totalNotFiltered' => $dataCount,
            
        ];

    }
  
    
}