<?php
namespace App\Http\Traits;
use DB;

trait AgentDeposits {
    

    public function getAgentDeposits($request) {
    
        $sort           = request()->input('sort') == "" ? 'created_at' : request()->input('sort');
        $order          = request()->input('order', 'desc');
        $search         = request()->input('filters.search');

        $data   = DB::table('agent_deposits as ad')
                        ->leftJoin('users as agent','agent.id', '=','ad.agent_id')
                        ->selectRaw('agent.name as name,
                        agent.role as role,
                        ad.id,
                        ad.amount,
                        ad.source,
                        ad.source_details,
                        ad.date_approved,
                        ad.date_deposited,
                        ad.remarks,
                        ad.status')
                        ->when($search, function($query,$search){
                            return $query->where('name', 'like' ,'%'.$search.'%')
                            ->orWhere('amount', 'like' ,'%'.$search.'%')
                            ->orWhere('source', 'like' ,'%'.$search.'%')
                            ->orWhere('source_details', 'like' ,'%'.$search.'%');
                        })
                        ->when($sort, function($query, $sort) use ($order){
                            return $query->orderBy('ad.'.$sort, $order);
                        })
                        // ->where('role', 'Super Agent')
                        // ->whereNull('ad.deleted_at')
                        ;

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
                    </button>';

            if($data->status == 'approved'){
                $action = '<button type="button" 
                            data-type="rejected"
                            data-url="'.route('agent-deposits.update',$data->id).'" 
                            class="btn btn-icon btn-danger btn-outline btn-confirmation" data-toggle="tooltip" data-title="Decline this deposit">
                            <i class="icon wb-thumb-down" aria-hidden="true"></i> 
                        </button>';
            }

            $finalData[] = [
              
                'id'            => $offset++ ,
                'name'          => $data->name,
                'amount'        => $data->amount,
                'source'         => $data->source,
                'source_details' => $data->source_details,
                'date_deposited' => date('m-d-Y',strtotime($data->date_deposited)),
                'date_approved'  => date('m-d-Y',strtotime($data->date_approved)),
                'status'         => $data->status,
                'action'         => $action
        
            ];
        }

        return [
        
            'rows'             => $finalData,
            'total'            => $dataCount,
            'totalNotFiltered' => $dataCount,
            
        ];

    }
  
    
}