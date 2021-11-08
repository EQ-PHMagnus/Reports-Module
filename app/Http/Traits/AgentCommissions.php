<?php
namespace App\Http\Traits;
use DB;

trait AgentCommissions {
    

    public function getAgentCommissions($request,$roleType,$format) {

        if($roleType == 'super_agent'){
            $roleType = 'super agent';
        }

        $type               =    $request->input('filters.group') ?? $request->input('group'); // select type if daily/montly/yearly
        $limit              =    intval($request->input('limit', 10)); // pagination
        $offset             =    intval($request->input('offset', 0)); // pagination
        $collectionTable    =    $this->getAgentCommissionData($request,$roleType); 
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
                       return [ 'count' => $perday->count(), 'amount' => $perday->sum('ac_amount')
                                ,'total_commission' => $perday->sum('commission')];
                    });
                });   
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                   
                        $rows[] = [
                            'date'  => $keyDate,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['amount'],2),
                            'commission'   => number_format($valCount['total_commission'],2)
                        ];
                    }
                }
                break;
            case 'monthly';

                $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month_and_year')->map(function($permonth){
                        return [ 'count' => $permonth->count(), 'amount' => $permonth->sum('ac_amount')
                        ,'total_commission' => $permonth->sum('commission')];
                    });
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'  => $keyDate,
                            'count' => $valCount['count'] ?? null,
                            'sum'   => '₱ '.number_format($valCount['amount'] ?? null,2),
                            'commission'   => number_format($valCount['total_commission'],2)
                        ];
                    }
                }
                break;
            case 'yearly';
             
                $groupDate = $collectionTable->groupBy('year')->map(function($peryear){
                    return [ 'count' => $peryear->count(), 'amount' => $peryear->sum('ac_amount')
                    ,'total_commission' => $peryear->sum('commission')];
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    $rows[] = [
                        'date'  => $key,
                        'count' => $val['count'],
                        'sum'   => '₱ '.number_format($val['amount'] ?? null,2),
                        'commission'   => number_format($val['total_commission'],2)
                    ];
                }
                break;
            default:
                $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month_and_day')->map(function($perday){
                        return [ 'count' => $perday->count(), 'amount' => $perday->sum('ac_amount')
                        ,'total_commission' => $perday->sum('commission')];
                    });
                }); 
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'  => $keyDate.', '.$key,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['amount'],2),
                            'commission'   => number_format($valCount['total_commission'],2)
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

    public function getAgentCommissionData($request,$roleType){


        $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
        $order      =    $request->input('order', 'desc');
        $from       =    date('Y-m-d h:i:s', strtotime($request->input('filters.from')));
        $to         =    date('Y-m-d h:i:s', strtotime($request->input('filters.to'))) ?? $from;

        $data   = DB::table('agent_commissions as ac')
        ->leftJoin('users as agent','agent.id', '=','ac.super_agent_id')
        ->selectRaw('agent.name as name,
        agent.role as role,
        ac.id,
        ac.commission,
        ac.amount,
        ac.commission_date,
        ac.level,
        ac.type,
        ac.created_at')
       
        ->when($from, function ($query , $from) use ($to) {
            return $query->whereBetween('ac.commission_date', [$from, $to]);
        })
        ->when($sort, function($query, $sort) use ($order){
            return $query->orderBy('ac.'.$sort, $order);
        })
        ->where('ac.type', $roleType)
        // ->whereNull('ac.deleted_at')
        ;
        
      


        $data = $this->getCollectionData($data);
        return $data;
    }


    public function getCollectionData($data){

        $query       =    [];
        
        foreach($data->get() as $key => $val){
           
        
            $query[$key] = [
                'year'          => date('Y', strtotime($val->commission_date ?? $val->created_at ?? $val->created_at)),
                'month'         => date('F', strtotime($val->commission_date ?? $val->created_at)),
                'day'           => date('j', strtotime($val->commission_date ?? $val->created_at)),
                'month_and_day' => date('F', strtotime($val->commission_date ?? $val->created_at)).' '.date('j', strtotime($val->commission_date ?? $val->created_at)),
                'month_and_year' => date('F', strtotime($val->commission_date ?? $val->created_at)).' '.date('Y', strtotime($val->commission_date ?? $val->created_at)),
                'full_date'     => date('F', strtotime($val->commission_date ?? $val->created_at)).' '.date('j', strtotime($val->commission_date ?? $val->created_at)).','.date('Y', strtotime($val->commission_date ?? $val->created_at)),
                'time'          => date('H:i:s', strtotime($val->commission_date ?? $val->created_at)),
                "ac_amount"    => $val->amount ?? null,
                "commission"    => $val->commission ?? null,
                "date"          => $val->created_at ?? null,
                "commission_date" => $val->commission_date ?? $val->created_at,
            ];
        
        }
        $collection = collect($query);
        return $collection;
    }
}