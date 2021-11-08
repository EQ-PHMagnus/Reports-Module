<?php
namespace App\Http\Traits;
use DB;

trait AgentCommissions {
    

    public function getAgentCommissions($request,$type,$format) {

        if($type == 'super_agent'){
            $type = 'super agent';
        }
    
        $sort           = request()->input('sort') == "" ? 'created_at' : request()->input('sort');
        $order          = request()->input('order', 'desc');
        $search         = request()->input('filters.search');
        $amount         = request()->input('filters.amount');
        $from           = date('Y-m-d h:i:s', strtotime($request->input('filters.from')));
        $to             = date('Y-m-d h:i:s', strtotime($request->input('filters.to'))) ?? $from;
        $stat           =  request()->input('filters.status');
        
        $data   = DB::table('agent_commissions as ac')
                        ->leftJoin('users as agent','agent.id', '=','ac.super_agent_id')
                        ->selectRaw('agent.name as name,
                        agent.role as role,
                        ac.id,
                        ac.commission,
                        ac.amount,
                        ac.commission_date,
                        ac.level,
                        ac.type')
                        ->when($search, function($query,$search){
                            return $query->where('name', 'like' ,'%'.$search.'%')
                            ->orWhere('ac.level', 'like' ,'%'.$search.'%');
                        })
                        ->when($amount, function($query,$amount){
                            return $query->where('amount' , '<=' ,$amount);
                        })
                        ->when($from, function ($query , $from) use ($to) {
                            return $query->whereBetween('ac.commission_date', [$from, $to]);
                        })
                        ->when($sort, function($query, $sort) use ($order){
                            return $query->orderBy('ac.'.$sort, $order);
                        })
                        ->where('ac.type', $type)
                        // ->whereNull('ac.deleted_at')
                        ;

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
            

            $finalData[] = [
              
                'id'                => $offset++ ,
                'name'              => $data->name,
                'commission'        => $data->commission,
                'amount'            => $data->amount ? moneyFormat($data->amount): '',
                'commission_date'   => date('m-d-Y',strtotime($data->commission_date)),
                'level'             => $data->level,
        
            ];
            
        }

        return [
        
            'rows'             => $finalData,
            'total'            => $dataCount,
            'totalNotFiltered' => $dataCount,
            
        ];

    }
  
    
}