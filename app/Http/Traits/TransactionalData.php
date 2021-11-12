<?php
namespace App\Http\Traits;
use DB;
use App\Models\Agent;

trait TransactionalData {
    public function getTransactions($request, $format, $type = null){
        $limit           = intval($request->input('limit', 10));  // pagination
        $offset          = intval($request->input('offset', 0));  // pagination
        $sort            = request()->input('sort');
        $order           = request()->input('order', 'desc');
        $search          = request()->input('search') ?? '';

        switch($type) {
            case 'bets':
                $collectionTable = $this->getBetData($request);
                $searchable_cols = ['user.username', 'arena.name'];
            break;
            case 'fights':
                $collectionTable = $this->getFightsData($request);
                $searchable_cols = ['arena.name', 'fights.meron', 'fights.wala'];
            break;
            case 'agent' || 'super_agent':
                $collectionTable = $this->getAgentCommissionData($request, $type);
                $searchable_cols = ['agent.name', 'superagent.name'];
            break;
            default:
                $collectionTable = $this->getBetData($request);
                $searchable_cols = ['user.username', 'arena.name'];
            break;
        }

        if($format == 'excel'){
            return $collectionTable->get();
        }

        $collectionTable->when($search, function($query, $search) use($searchable_cols) {
            $query->where(function($query) use ($searchable_cols, $search){
                foreach($searchable_cols as $i => $col){
                    $query->orWhere($col, 'like' ,'%'.$search.'%');
                }
                return $query;
              });
            return $query;
        })
        ->when($sort, function($query, $sort) use ($order){
            return $query->orderBy($sort, $order);
        });

        $countRows   = $collectionTable->count();
        $formData   = $collectionTable->skip(intval(request()->input('offset', 0)))
                            ->limit(intval(request()->input('limit', 10)))
                            ->get();

        return [
            'rows'                  =>   $formData,
            'total'                 =>   $countRows,
            'totalNotFiltered'      =>   $countRows,
        ];
    }

    public function getBetData($request){

        $data = DB::table('bets as bet')
        ->leftJoin('fights as fight', 'fight.id', '=', 'bet.fight_id')
        ->leftJoin('arenas as arena', 'arena.id', '=', 'fight.arena_id')
        ->leftJoin('players as player', 'player.id', '=', 'bet.player_id')
        ->leftJoin('agents as agent', 'agent.id', '=', 'player.agent_id')
        ->selectRaw('
            bet.bet_date,
            bet.pick,
            bet.odds,
            bet.amount,
            bet.prize,
            bet.result,
            bet.result_date,
            arena.name as arena,
            fight.fight_no as fight_no,
            player.name as name,
            fight.schedule as fight_schedule,
            fight.fight_no as fight_no,
            player.username as affiliate_name,
            agent.name as agent_name
        ')
        ->whereNull('bet.deleted_at');
           
        $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
        $order      =    $request->input('order', 'desc');
        
        $data->when($sort, function($query, $sort) use ($order){
            return $query->orderBy('bet.'.$sort, $order);
        });
        return $data;
    }

    public function getFightsData($request){

        $data = DB::table('fights as fight')
        ->leftJoin('arenas as arena', 'arena.id', '=', 'fight.arena_id')
        ->selectRaw('
            fight.schedule,
            arena.name as arena,
            fight.fight_no as fight_no,
            fight.meron,
            fight.meron_lb,
            fight.meron_wt,
            fight.meron_wb,
            fight.wala,
            fight.wala_lb,
            fight.wala_wb,
            fight.wala_wt
        ')
        ->whereNull('fight.deleted_at');
        $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
        $order      =    $request->input('order', 'desc');
        
        $data->when($sort, function($query, $sort) use ($order){
            return $query->orderBy('fight.'.$sort, $order);
        });
        return $data;
    }

    public function getAgentCommissionData($request, $roleType){
        $sort      = $request->input('sort') == "" ? 'created_at' : $request->input('sort');
        $order     = $request->input('order', 'desc');

        $data      = DB::table('agent_commissions as ac')
            ->leftJoin('agents as agent','agent.id', '=', 'ac.agent_id')
            ->leftJoin('agents as superagent','superagent.id', '=', 'ac.super_agent_id')
            ->selectRaw('agent.name as name,
            agent.role as role,
            ac.id,
            ac.commission,
            ac.amount,
            ac.commission_date,
            ac.level,
            ac.type,
            ac.created_at,
            superagent.name as agent_name')
            ->when($sort, function($query, $sort) use ($order){
                return $query->orderBy('ac.'.$sort, $order);
            })
            ->where('ac.type', str_replace('_', ' ', $roleType));
        $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
        $order      =    $request->input('order', 'desc');
        
        $data->when($sort, function($query, $sort) use ($order){
            return $query->orderBy('ac.'.$sort, $order);
        });

        return $data;
    }

    public function getMasterAgentDeposits($request, $format, $roleType) {

        $sort           = request()->input('sort') == "" ? 'created_at' : request()->input('sort');
        $order          = request()->input('order', 'desc');
        $search         = request()->input('filters.search');
        $amount         = request()->input('filters.amount');
        $from           = date('Y-m-d h:i:s', strtotime($request->input('filters.from')));
        $to             = date('Y-m-d h:i:s', strtotime($request->input('filters.to'))) ?? $from;
        $stat           =  request()->input('filters.status');

        $searchable_cols = ['agent.name', 'ad.source', 'superagent.name'];

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