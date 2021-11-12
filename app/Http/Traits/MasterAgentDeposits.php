<?php
namespace App\Http\Traits;
use DB;
use App\Models\Agent;

trait MasterAgentDeposits {
    

    public function getMasterAgentDeposits($request,$roleType,$format) {

        if($roleType == 'super_agent'){
            $roleType = 'super agent';
        }

        $type               =    $request->input('filters.group') ?? $request->input('group'); // select type if daily/montly/yearly
        $limit              =    intval($request->input('limit', 10)); // pagination
        $offset             =    intval($request->input('offset', 0)); // pagination
        $collectionTable    =    $this->masterAgentDepositsData($request,$roleType); 
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
                           
                        ];
                    }
                }
                break;
            case 'monthly';

                $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month_and_year')->map(function($permonth){
                        return [ 'count' => $permonth->count(), 'amount' => $permonth->sum('ac_amount')
                        ];
                    });
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'  => $keyDate,
                            'count' => $valCount['count'] ?? null,
                            'sum'   => '₱ '.number_format($valCount['amount'] ?? null,2),
                           
                        ];
                    }
                }
                break;
            case 'yearly';
             
                $groupDate = $collectionTable->groupBy('year')->map(function($peryear){
                    return [ 'count' => $peryear->count(), 'amount' => $peryear->sum('ac_amount')
                    ];
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
                        ];
                    });
                }); 
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'  => $keyDate.', '.$key,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['amount'],2),
                           
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

    public function masterAgentDepositsData($request,$roleType){


        $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
        $order      =    $request->input('order', 'desc');
       


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
        // ->when($search, function($query,$search){
        //     return $query->where('name', 'like' ,'%'.$search.'%')
        //     ->orWhere('source', 'like' ,'%'.$search.'%')
        //     ->orWhere('source_details', 'like' ,'%'.$search.'%');
        // })
        // ->when($amount, function($query,$amount){
        //     return $query->where('amount' , '<=' ,$amount);
        // })
        ->when($sort, function($query, $sort) use ($order){
            return $query->orderBy('ad.'.$sort, $order);
        })
        // ->when($stat, function($query,$stat){
        //     return $query->where('status', $stat);
        // })
        // ->when($search, function($query, $search) use($searchable_cols) {
        //     $query->where(function($query) use ($searchable_cols, $search){
        //         foreach($searchable_cols as $i => $col){
        //             $query->orWhere($col, 'like' ,'%'.$search.'%');
        //         }
        //         return $query;
        //       });
        //     return $query;
        // })
        ->where('status','!=', 'pending')
        // ->whereNull('ad.deleted_at')
        ;

        
    
        $data = $this->getCollectionData($data);
        return $data;
    }


    public function getCollectionData($data){

        $query       =    [];
        
        foreach($data->get() as $key => $val){
           
        
            $query[$key] = [
                'year'          => date('Y', strtotime($val->date_deposited ?? $val->created_at ?? $val->created_at)),
                'month'         => date('F', strtotime($val->date_deposited ?? $val->created_at)),
                'day'           => date('j', strtotime($val->date_deposited ?? $val->created_at)),
                'month_and_day' => date('F', strtotime($val->date_deposited ?? $val->created_at)).' '.date('j', strtotime($val->date_deposited ?? $val->created_at)),
                'month_and_year' => date('F', strtotime($val->date_deposited ?? $val->created_at)).' '.date('Y', strtotime($val->date_deposited ?? $val->created_at)),
                'full_date'     => date('F', strtotime($val->date_deposited ?? $val->created_at)).' '.date('j', strtotime($val->date_deposited ?? $val->created_at)).','.date('Y', strtotime($val->date_deposited ?? $val->created_at)),
                'time'          => date('H:i:s', strtotime($val->date_deposited ?? $val->created_at)),
                "ac_amount"    => $val->amount ?? null,
                "commission"    => $val->commission ?? null,
                "date"          => $val->created_at ?? null,
                "date_deposited" => $val->date_deposited ?? $val->created_at,
                "date_approved" => $val->date_approved ?? $val->created_at,
            ];
        
        }
        $collection = collect($query);
        return $collection;
    }
}