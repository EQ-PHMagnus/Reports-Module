<?php
namespace App\Http\Traits;
use DB;
trait Players {

    public function getPlayers($request,$reportType,$format){

        $type               =    $request->input('filters.group') ?? $request->input('group'); // select type if daily/montly/yearly
        $limit              =    intval($request->input('limit', 10)); // pagination
        $offset             =    intval($request->input('offset', 0)); // pagination
        $collectionTable    =    $this->getPlayerData($request,$reportType); 
        $rows               =    []; // all array result to be display in data tables
        $yearCount          =    [];
        $monthYearCount     =    [];
        $yearAmount         =    [];
        $monthYearAmount    =    [];

        // filter collections group by daily/monthly/yearly
        switch($type){
            case 'daily':
                $groupDate = $collectionTable->groupBy('date')->map(function($data,$year){
                    return $data->groupBy('full_date')->map(function($perday){
                       return [ 'count' => $perday->count(), 'amount' => $perday->sum('bet_amount')];
                    });
                });   
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                   
                        $rows[] = [
                            'date'  => $keyDate,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['amount'],2)
                        ];
                    }
                }
                break;
            case 'monthly';

           
                $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month_and_year')->map(function($permonth){
                        return [ 'count' => $permonth->count(), 'amount' => $permonth->sum('bet_amount')];
                    });
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'  => $keyDate,
                            'count' => $valCount['count'] ?? null,
                            'sum'   => '₱ '.number_format($valCount['amount'] ?? null,2)
                        ];
                    }
                }
                break;
            case 'yearly';
            
                $groupDate = $collectionTable->groupBy('year')->map(function($peryear){
                    return [ 'count' => $peryear->count(), 'amount' => $peryear->sum('bet_amount')];
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    $rows[] = [
                        'date'  => $key,
                        'count' => $val['count'],
                        'sum'   => '₱ '.number_format($val['amount'] ?? null,2)
                    ];
                }
                break;
            default:
                $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month_and_day')->map(function($perday){
                        return [ 'count' => $perday->count(), 'amount' => $perday->sum('bet_amount')];
                    });
                }); 
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'  => $keyDate.', '.$key,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['amount'],2)
                        ];
                    }
                }
        }

        if($format == 'excel'){
            return $rows;
        }
 
        //determine offset and limit of rows for pagination
        $result      = array_slice($rows,intval($request->input('offset', 0)),intval($request->input('limit', 10)));
        $countRows   = count($rows);

        return [
            'rows'                  =>   $result,
            'total'                 =>   $countRows,
            'totalNotFiltered'      =>   $countRows,
        ];
    }


    public function getPlayerData($request,$type){

        $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
        $order      =    $request->input('order', 'desc');
       
        $data   = DB::table('transactions as trans')
        ->leftJoin('players as player','player.id', '=','trans.player_id')
        ->leftJoin('agents as agent','agent.id', '=','player.agent_id')
        ->selectRaw('player.name as name,
        player.dob,
        trans.amount,
        player.mobile_number,
        trans.status,
        trans.transaction_date,
        agent.name as agent_name')
        ->when($sort, function($query, $sort) use ($order){
            return $query->orderBy('trans.'.$sort, $order);
        })
        ->where('trans.type', $type)
        ->whereNull('trans.deleted_at')
        ;


        $data = $this->getCollectionData($data);

        return $data;
    }

    public function getCollectionData($data){

        $query       =    [];
        
        foreach($data->get() as $key => $val){
            $query[$key] = [
                'year'          => date('Y', strtotime($val->created_at ?? date('Y-m-d h:i:s') ?? date('Y-m-d h:i:s'))),
                'month'         => date('F', strtotime($val->created_at ?? date('Y-m-d h:i:s'))),
                'day'           => date('j', strtotime($val->created_at ?? date('Y-m-d h:i:s'))),
                'month_and_day' => date('F', strtotime($val->created_at ?? date('Y-m-d h:i:s'))).' '.date('j', strtotime($val->created_at ?? date('Y-m-d h:i:s'))),
                'month_and_year' => date('F', strtotime($val->created_at ?? date('Y-m-d h:i:s'))).' '.date('Y', strtotime($val->created_at ?? date('Y-m-d h:i:s'))),
                'full_date'     => date('F', strtotime($val->created_at ?? date('Y-m-d h:i:s'))).' '.date('j', strtotime($val->created_at ?? date('Y-m-d h:i:s'))).','.date('Y', strtotime($val->created_at ?? date('Y-m-d h:i:s'))),
                'time'          => date('H:i:s', strtotime($val->created_at ?? date('Y-m-d h:i:s'))),
                "bet_amount"    => $val->amount ?? null,
                "date"          => $val->created_at ?? null,
            ];
        }
        $collection = collect($query);
        return $collection;
    }

    
}