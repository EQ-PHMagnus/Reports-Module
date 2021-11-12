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
}