<?php
namespace App\Http\Traits;
use DB;
trait Reports {


    public function getArena($request,$reportType){

        $type               =    $request->input('filters.group') ?? $request->input('group'); // select type if daily/montly/yearly
        $limit              =    intval($request->input('limit', 10)); // pagination
        $offset             =    intval($request->input('offset', 0)); // pagination
        $collectionTable    =    $this->getBetData($request,'table'); 
        $collectionChart    =    $this->getBetData($request,'chart'); 
        $rows               =    []; // all array result to be display in data tables
        $chartData          =    []; // all array result to be display in chart view
        $yearCount          =    [];
        $monthYearCount     =    [];
        $yearAmount         =    [];
        $monthYearAmount    =    [];
        $arena              =    []; // collect per arena

        if($reportType == 'total-count-fights-arena'){
            $collectionTable    =    $this->getFightData($request,'table'); 
            $collectionChart    =    $this->getFightData($request,'chart'); 
        }
        
        $totalBetsPerArena = $collectionTable->groupBy('arena')->map(function($perArena){
            return [ 'count' => $perArena->count(), 'sum' => $perArena->sum('bet_amount')];
        });
        
        foreach($totalBetsPerArena as $key => $val){
            $arena[] = [
                'arena'     => $key,
                'count'     => $val['count'],
                'sum'       => '₱ '.number_format($val['sum'],2)
            ];
        }
        
        // filter collections group by daily/monthly/yearly
        switch($type){
            case 'daily':
                $groupDate = $collectionTable->groupBy('arena')->map(function($data,$year){
                    return $data->groupBy('full_date')->map(function($perday){
                       return [ 'count' => $perday->count(), 'sum' => $perday->sum('bet_amount')];
                    });
                });   
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                   
                        $rows[] = [
                            'arena' => $key,
                            'date'  => $keyDate,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['sum'],2)
                        ];
                    }
                }
                break;
            case 'monthly';
                 // 1. collect chart data
                $yearCount         = $this->getChartData($collectionChart,'yearcount');
                $yearAmount        = $this->getChartData($collectionChart,'yearamount');
                $monthYearCount    = $this->getChartData($collectionChart,'monthcount');
                $monthYearAmount   = $this->getChartData($collectionChart,'monthamount');
            
        
                $groupDate = $collectionTable->groupBy('arena')->map(function($data,$year){
                    return $data->groupBy('month_and_year')->map(function($permonth){
                        return [ 'count' => $permonth->count(), 'sum' => $permonth->sum('bet_amount')];
                    });
                });
            
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                      
                        $rows[] = [
                            'arena' => $key,
                            'date'  => $keyDate,
                            'count' => $valCount['count'] ?? null,
                            'sum'   => '₱ '.number_format($valCount['sum'] ?? null,2)
                        ];
                    }
                }
                break;
            case 'yearly';
                $chartData[] = $collectionChart->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('year')->map(function($permonth){
                        return $permonth->count();
                    });
                });
              
                $groupDate = $collectionTable->groupBy('arena')->map(function($data,$year){
                    return $data->groupBy('year')->map(function($peryear,$data){
                        return ['arena' => $data, 'count' => $peryear->count(), 'sum' => $peryear->sum('bet_amount')];
                    });
                });
        
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                   
                    foreach($val as $key1 => $key2){
                        $rows[] = [
                            'arena' => $key,
                            'date'  => $key1,
                            'count' => $key2['count'],
                            'sum'   => '₱ '.number_format($key2['sum'] ?? null,2)
                        ];
                    }
                }
               
                break;
            default:
                $groupDate = $collectionTable->groupBy('arena')->map(function($data,$year){
                    return $data->groupBy('month_and_year')->map(function($permonth){
                        return [ 'count' => $permonth->count(), 'amount' => $permonth->sum('bet_amount')];
                    });
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'  => $keyDate.', '.$key,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['sum'],2)
                        ];
                    }
                }
        }

        
        //determine offset and limit of rows for pagination
        $result      = array_slice($rows,intval($request->input('offset', 0)),intval($request->input('limit', 10)));
        $countRows   = count($rows);

        return [
            'rows'                  =>   $result,
            'total'                 =>   $countRows,
            'totalNotFiltered'      =>   $countRows,
            'chartBarNumber'        =>   $this->formatBar($chartData,$yearCount,$monthYearCount,$type),
            'chartBarAmount'        =>   $this->formatBar($chartData,$yearAmount,$monthYearAmount,$type),

        ];
    }
    
    public function getBets($request){

        $type               =    $request->input('filters.group') ?? $request->input('group'); // select type if daily/montly/yearly
        $limit              =    intval($request->input('limit', 10)); // pagination
        $offset             =    intval($request->input('offset', 0)); // pagination
        $collectionTable    =    $this->getBetData($request,'table'); 
        $collectionChart    =    $this->getBetData($request,'chart'); 
        $rows               =    []; // all array result to be display in data tables
        $chartData          =    []; // all array result to be display in chart view
        $yearCount          =    [];
        $monthYearCount     =    [];
        $yearAmount         =    [];
        $monthYearAmount    =    [];

        // filter collections group by daily/monthly/yearly
        switch($type){
            case 'daily':
                $groupDate = $collectionTable->groupBy('arena')->map(function($data,$year){
                    return $data->groupBy('full_date')->map(function($perday){
                       return [ 'count' => $perday->count(), 'sum' => $perday->sum('bet_amount')];
                    });
                });   
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                   
                        $rows[] = [
                            'date'  => $keyDate,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['sum'],2)
                        ];
                    }
                }
                break;
            case 'monthly';

                // 1. collect chart data
                $yearCount         = $this->getChartData($collectionChart,'yearcount');
                $yearAmount        = $this->getChartData($collectionChart,'yearamount');
                $monthYearCount    = $this->getChartData($collectionChart,'monthcount');
                $monthYearAmount   = $this->getChartData($collectionChart,'monthamount');
            
           
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
                            'sum'   => '₱ '.number_format($valCount['sum'] ?? null,2)
                        ];
                    }
                }
                break;
            case 'yearly';
                $chartData[] = $collectionChart->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('year')->map(function($permonth){
                        return $permonth->count();
                    });
                });
                $groupDate = $collectionTable->groupBy('year')->map(function($peryear){
                    return [ 'count' => $peryear->count(), 'amount' => $peryear->sum('bet_amount')];
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    $rows[] = [
                        'date'  => $key,
                        'count' => $val['count'],
                        'sum'   => '₱ '.number_format($val['sum'] ?? null,2)
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
                            'sum'   => '₱ '.number_format($valCount['sum'],2)
                        ];
                    }
                }
        }
 
        //determine offset and limit of rows for pagination
        $result      = array_slice($rows,intval($request->input('offset', 0)),intval($request->input('limit', 10)));
        $countRows   = count($rows);

        return [
            'rows'                  =>   $result,
            'total'                 =>   $countRows,
            'totalNotFiltered'      =>   $countRows,
            'chartBarNumber'        =>   $this->formatBar($chartData,$yearCount,$monthYearCount,$type),
            'chartBarAmount'        =>   $this->formatBar($chartData,$yearAmount,$monthYearAmount,$type),
        
        ];
    }

    public function getFights($request){

        $type               =    $request->input('filters.group') ?? $request->input('group'); // select type if daily/montly/yearly
        $limit              =    intval($request->input('limit', 10)); // pagination
        $offset             =    intval($request->input('offset', 0)); // pagination
        $collectionTable    =    $this->getFightData($request,'table'); 
        $collectionChart    =    $this->getFightData($request,'chart'); 
        $rows               =    []; // all array result to be display in data tables
        $chartData          =    []; // all array result to be display in chart view
        $yearCount          =    [];
        $monthYearCount     =    [];
        $yearAmount         =    [];
        $monthYearAmount    =    [];

        // filter collections group by daily/monthly/yearly
        switch($type){
            case 'daily':
                $groupDate = $collectionTable->groupBy('arena')->map(function($data,$year){
                    return $data->groupBy('full_date')->map(function($perday){
                       return [ 'count' => $perday->count(), 'sum' => $perday->sum('bet_amount')];
                    });
                });   
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                   
                        $rows[] = [
                            'date'  => $keyDate,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['sum'],2)
                        ];
                    }
                }
                break;
            case 'monthly';

                // 1. collect chart data
                $yearCount         = $this->getChartData($collectionChart,'yearcount');
                $yearAmount        = $this->getChartData($collectionChart,'yearamount');
                $monthYearCount    = $this->getChartData($collectionChart,'monthcount');
                $monthYearAmount   = $this->getChartData($collectionChart,'monthamount');
            
           
                $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month_and_year')->map(function($permonth){
                        return [ 'count' => $permonth->count(), 'sum' => $permonth->sum('bet_amount')];
                    });
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'  => $keyDate,
                            'count' => $valCount['count'] ?? null,
                            'sum'   => '₱ '.number_format($valCount['sum'] ?? null,2)
                        ];
                    }
                }
                break;
            case 'yearly';
                $chartData[] = $collectionChart->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('year')->map(function($permonth){
                        return $permonth->count();
                    });
                });
                $groupDate = $collectionTable->groupBy('year')->map(function($peryear){
                    return [ 'count' => $peryear->count(), 'sum' => $peryear->sum('bet_amount')];
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    $rows[] = [
                        'date'  => $key,
                        'count' => $val['count'],
                        'sum'   => '₱ '.number_format($val['sum'] ?? null,2)
                    ];
                }
                break;
            default:
                $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month_and_day')->map(function($perday){
                        return [ 'count' => $perday->count(), 'sum' => $perday->sum('bet_amount')];
                    });
                }); 
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'  => $keyDate.', '.$key,
                            'count' => $valCount['count'],
                            'sum'   => '₱ '.number_format($valCount['sum'],2)
                        ];
                    }
                }
        }
 
        //determine offset and limit of rows for pagination
        $result      = array_slice($rows,intval($request->input('offset', 0)),intval($request->input('limit', 10)));
        $countRows   = count($rows);

        return [
            'rows'                  =>   $result,
            'total'                 =>   $countRows,
            'totalNotFiltered'      =>   $countRows,
            'chartBarNumber'        =>   $this->formatBar($chartData,$yearCount,$monthYearCount,$type),
            'chartBarAmount'        =>   $this->formatBar($chartData,$yearAmount,$monthYearAmount,$type),
        
        ];
    }

    public function getBetData($request,$type){

       
        $data = DB::table('bets as bet')
        ->leftJoin('fights as fight', 'fight.id', '=', 'bet.fight_id')
        ->leftJoin('arenas as arena', 'arena.id', '=', 'fight.arena_id')
        ->leftJoin('users as user', 'user.id', '=', 'bet.user_id')
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
            user.name as name
        ')
        ->whereNull('bet.deleted_at');

        if($type == 'table'){
            
            $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
            $order      =    $request->input('order', 'desc');
            $from       =    date('Y-m-d h:i:s', strtotime($request->input('filters.from')));
            $to         =    date('Y-m-d h:i:s', strtotime($request->input('filters.to'))) ?? $from;

            $data->when($sort, function($query, $sort) use ($order){
                return $query->orderBy('bet.'.$sort, $order);
            })
            ->when($from, function ($query , $from) use ($to) {
                return $query->whereBetween('bet.bet_date', [$from, $to]);
            });
        }

        $data = $this->getCollectionData($data);

        return $data;
    }

    public function getFightData($request,$type){

       
        $data = DB::table('fights as fight')
        ->leftJoin('arenas as arena', 'arena.id', '=', 'fight.arena_id')
        ->selectRaw('
            fight.schedule,
            arena.name as arena,
            fight.fight_no as fight_no
        ')
        ->whereNull('fight.deleted_at');

        if($type == 'table'){
            
            $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
            $order      =    $request->input('order', 'desc');
            $from       =    date('Y-m-d h:i:s', strtotime($request->input('filters.from')));
            $to         =    date('Y-m-d h:i:s', strtotime($request->input('filters.to'))) ?? $from;

            $data->when($sort, function($query, $sort) use ($order){
                return $query->orderBy('fight.'.$sort, $order);
            })
            ->when($from, function ($query , $from) use ($to) {
                return $query->whereBetween('fight.schedule', [$from, $to]);
            });
        }

        $data = $this->getCollectionData($data);

        return $data;
    }

    public function getCollectionData($data){

        $bets       =    [];
        
        foreach($data->get() as $key => $val){
            $bets[$key] = [
                'year'          => date('Y', strtotime($val->bet_date ?? $val->schedule ?? $val->schedule)),
                'month'         => date('F', strtotime($val->bet_date ?? $val->schedule)),
                'day'           => date('j', strtotime($val->bet_date ?? $val->schedule)),
                'month_and_day' => date('F', strtotime($val->bet_date ?? $val->schedule)).' '.date('j', strtotime($val->bet_date ?? $val->schedule)),
                'month_and_year' => date('F', strtotime($val->bet_date ?? $val->schedule)).' '.date('Y', strtotime($val->bet_date ?? $val->schedule)),
                'arena_and_year'=> $val->arena.','. date('Y', strtotime($val->bet_date ?? $val->schedule)),
                'full_date'     => date('F', strtotime($val->bet_date ?? $val->schedule)).' '.date('j', strtotime($val->bet_date ?? $val->schedule)).','.date('Y', strtotime($val->bet_date ?? $val->schedule)),
                'time'          => date('H:i:s', strtotime($val->bet_date ?? $val->schedule)),
                'arena'         => $val->arena,
                'fight_no'      => $val->fight_no,
                "bet_amount"    => $val->amount ?? null,
                "bet_date"      => $val->bet_date ?? $val->schedule,
            ];
        }
        $collection = collect($bets);
        return $collection;
    }

    public function getChartData($collection,$collect){
        switch($collect){
            case 'yearcount';
                return $collection->groupBy('month')->map(function($data,$year){
                    return $data->groupBy('year')->map(function($permonth){
                        return $permonth->count();
                    });
                });
                break;
            case 'monthcount';
                return $collection->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month')->map(function($permonth){
                        return $permonth->count();
                    });
                });
                break;

            case 'yearamount';
                return $collection->groupBy('month')->map(function($data,$year){
                    return $data->groupBy('year')->map(function($permonth){
                        return $permonth->sum('bet_amount');
                    });
                });
                break;
            case 'monthamount';
                return $collection->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month')->map(function($permonth){
                        return $permonth->sum('bet_amount');
                    });
                });
                break;

        }
    }
    
}