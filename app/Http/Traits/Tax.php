<?php
namespace App\Http\Traits;
use DB;
trait Tax {


    public function getTax($request,$format,$tax = null){

        $type               =    $request->input('filters.group') ?? $request->input('group'); // select type if daily/montly/yearly
        $limit              =    intval($request->input('limit', 10)); // pagination
        $offset             =    intval($request->input('offset', 0)); // pagination
        $collectionTable    =    $this->getTaxData($request,'table',$tax); 
        $rows               =    []; // all array result to be display in data tables
        $yearCount          =    [];
        $monthYearCount     =    [];
        $yearAmount         =    [];
        $monthYearAmount    =    [];

        // filter collections group by daily/monthly/yearly
        switch($type){
            case 'daily':
                $groupDate = $collectionTable->groupBy('arena')->map(function($data,$year){
                    return $data->groupBy('full_date')->map(function($perday){
                       return [ 'amount' => $perday->sum('bet_amount'), 
                                'sum_amount' => $perday->sum('bet_amount') * 0.5,
                                // GRB
                                'grb' => $this->getTaxComputations($perday->sum('bet_amount'),'grb'),
                                'vat' => $this->getTaxComputations($perday->sum('bet_amount'),'vat'),
                                'total-grb' => $this->getTaxComputations($perday->sum('bet_amount'),'total-grb'),
                                // GROSS COMMISSION
                                'basis-gr' => $this->getTaxComputations($perday->sum('bet_amount'),'basis-gr'),
                                'basis-bets' => $this->getTaxComputations($perday->sum('bet_amount'),'basis-bets'),
                                // NET COMMISSION
                                'gr_basis_gc' => $this->getTaxComputations($perday->sum('bet_amount'),'gr_basis_gc'),
                                'gr_basis_with_holding' => $this->getTaxComputations($perday->sum('bet_amount'),'gr_basis_with_holding'),
                                'gr_basis_nc' => $this->getTaxComputations($perday->sum('bet_amount'),'gr_basis_nc'),
                                'tb_basis_gc' => $this->getTaxComputations($perday->sum('bet_amount'),'tb_basis_gc'),
                                'tb_basis_with_holding' => $this->getTaxComputations($perday->sum('bet_amount'),'tb_basis_with_holding'),
                                'tb_basis_nc' => $this->getTaxComputations($perday->sum('bet_amount'),'tb_basis_nc'),
                                //FINAL TAX
                                'total_winnings' => $this->getTaxComputations($perday->sum('bet_amount'),'total_winnings'),
                                'final_tax' => $this->getTaxComputations($perday->sum('bet_amount'),'final_tax'),
                                'net_winnings' => $this->getTaxComputations($perday->sum('bet_amount'),'net_winnings'),
                            ];
                    });
                });   
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                   
                        $rows[] = [
                            'date'      => $keyDate,
                            'amount'    => '₱ '.number_format($valCount['amount'] ?? null,2),
                            'sum'       => '₱ '.number_format($valCount['sum_amount'],2),
                            // GRB
                            'grb'       =>  $valCount['grb'],
                            'vat'       =>  $valCount['vat'],
                            'total-grb' =>  $valCount['total-grb'],
                             // GROSS COMMISSION
                            'basis-gr'  =>  $valCount['basis-gr'],
                            'basis-bets'=>  $valCount['basis-bets'],
                            // NET COMMISSION
                            'gr_basis_gc' => $valCount['gr_basis_gc'],
                            'gr_basis_with_holding' => $valCount['gr_basis_with_holding'],
                            'gr_basis_nc' => $valCount['gr_basis_nc'],
                            'tb_basis_gc' => $valCount['tb_basis_gc'],
                            'tb_basis_with_holding' => $valCount['tb_basis_with_holding'],
                            'tb_basis_nc' => $valCount['tb_basis_nc'],
                            // FINAL TAX
                            'total_winnings' => $valCount['total_winnings'],
                            'final_tax' => $valCount['final_tax'],
                            'net_winnings' => $valCount['net_winnings'],
                        ];
                    }
                }
                break;
            case 'monthly';

                $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
                    return $data->groupBy('month_and_year')->map(function($permonth){
                        return [ 'amount' => $permonth->sum('bet_amount'),
                            'sum_amount' => $permonth->sum('bet_amount') * 0.5,
                            'grb' => $this->getTaxComputations($permonth->sum('bet_amount'),'grb'),
                            'vat' => $this->getTaxComputations($permonth->sum('bet_amount'),'vat'),
                            'total-grb' => $this->getTaxComputations($permonth->sum('bet_amount'),'total-grb'),
                            'total-grb' => $this->getTaxComputations($permonth->sum('bet_amount'),'total-grb'),
                            'basis-gr' => $this->getTaxComputations($permonth->sum('bet_amount'),'basis-gr'),
                            'basis-bets' => $this->getTaxComputations($permonth->sum('bet_amount'),'basis-bets'),
                          // NET COMMISSION
                          'gr_basis_gc' => $this->getTaxComputations($permonth->sum('bet_amount'),'gr_basis_gc'),
                          'gr_basis_with_holding' => $this->getTaxComputations($permonth->sum('bet_amount'),'gr_basis_with_holding'),
                          'gr_basis_nc' => $this->getTaxComputations($permonth->sum('bet_amount'),'gr_basis_nc'),
                          'tb_basis_gc' => $this->getTaxComputations($permonth->sum('bet_amount'),'tb_basis_gc'),
                          'tb_basis_with_holding' => $this->getTaxComputations($permonth->sum('bet_amount'),'tb_basis_with_holding'),
                          'tb_basis_nc' => $this->getTaxComputations($permonth->sum('bet_amount'),'tb_basis_nc'),
                           //FINAL TAX
                           'total_winnings' => $this->getTaxComputations($permonth->sum('bet_amount'),'total_winnings'),
                           'final_tax' => $this->getTaxComputations($permonth->sum('bet_amount'),'final_tax'),
                           'net_winnings' => $this->getTaxComputations($permonth->sum('bet_amount'),'net_winnings'),
                        ];
                    });
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    foreach($val as $keyDate => $valCount){
                        $rows[] = [
                            'date'      => $keyDate,
                            'amount'    => '₱ '.number_format($valCount['amount'] ?? null,2),
                            'sum'       => '₱ '.number_format($valCount['sum_amount'] ?? null,2),
                            'grb'       =>  $valCount['grb'],
                            'vat'       =>  $valCount['vat'],
                            'total-grb' =>  $valCount['total-grb'],
                            'basis-gr'  =>  $valCount['basis-gr'],
                            'basis-bets'=>  $valCount['basis-bets'],
                            // NET COMMISSION
                            'gr_basis_gc' => $valCount['gr_basis_gc'],
                            'gr_basis_with_holding' => $valCount['gr_basis_with_holding'],
                            'gr_basis_nc' => $valCount['gr_basis_nc'],
                            'tb_basis_gc' => $valCount['tb_basis_gc'],
                            'tb_basis_with_holding' => $valCount['tb_basis_with_holding'],
                            'tb_basis_nc' => $valCount['tb_basis_nc'],
                            // FINAL TAX
                            'total_winnings' => $valCount['total_winnings'],
                            'final_tax' => $valCount['final_tax'],
                            'net_winnings' => $valCount['net_winnings'],
                        ];
                    }
                }
                break;
            case 'yearly';
             
                $groupDate = $collectionTable->groupBy('year')->map(function($peryear){
                    return [ 'amount' => $peryear->sum('bet_amount'), 
                    'sum_amount' => $peryear->sum('bet_amount') * 0.5,
                    'grb' => $this->getTaxComputations($peryear->sum('bet_amount'),'grb'),
                    'vat' => $this->getTaxComputations($peryear->sum('bet_amount'),'vat'),
                    'total-grb' => $this->getTaxComputations($peryear->sum('bet_amount'),'total-grb'),
                    'total-grb' => $this->getTaxComputations($peryear->sum('bet_amount'),'total-grb'),
                    'basis-gr' => $this->getTaxComputations($peryear->sum('bet_amount'),'basis-gr'),
                    'basis-bets' => $this->getTaxComputations($peryear->sum('bet_amount'),'basis-bets'),
                    // NET COMMISSION
                    'gr_basis_gc' => $this->getTaxComputations($peryear->sum('bet_amount'),'gr_basis_gc'),
                    'gr_basis_with_holding' => $this->getTaxComputations($peryear->sum('bet_amount'),'gr_basis_with_holding'),
                    'gr_basis_nc' => $this->getTaxComputations($peryear->sum('bet_amount'),'gr_basis_nc'),
                    'tb_basis_gc' => $this->getTaxComputations($peryear->sum('bet_amount'),'tb_basis_gc'),
                    'tb_basis_with_holding' => $this->getTaxComputations($peryear->sum('bet_amount'),'tb_basis_with_holding'),
                    'tb_basis_nc' => $this->getTaxComputations($peryear->sum('bet_amount'),'tb_basis_nc'),
                     //FINAL TAX
                     'total_winnings' => $this->getTaxComputations($peryear->sum('bet_amount'),'total_winnings'),
                     'final_tax' => $this->getTaxComputations($peryear->sum('bet_amount'),'final_tax'),
                     'net_winnings' => $this->getTaxComputations($peryear->sum('bet_amount'),'net_winnings'),
                ];
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    $rows[] = [
                        'date'      => $key,
                        'amount'    => '₱ '.number_format($val['amount'] ?? null,2),
                        'sum'       => '₱ '.number_format($val['sum_amount'] ?? null,2),
                        'grb'       =>  $val['grb'],
                        'vat'       =>  $val['vat'],
                        'total-grb' =>  $val['total-grb'],
                        'basis-gr'  =>  $val['basis-gr'],
                        'basis-bets'=>  $val['basis-bets'],
                        // NET COMMISSION
                        'gr_basis_gc' => $val['gr_basis_gc'],
                        'gr_basis_with_holding' => $val['gr_basis_with_holding'],
                        'gr_basis_nc' => $val['gr_basis_nc'],
                        'tb_basis_gc' => $val['tb_basis_gc'],
                        'tb_basis_with_holding' => $val['tb_basis_with_holding'],
                        'tb_basis_nc' => $val['tb_basis_nc'],
                         // FINAL TAX
                         'total_winnings' => $val['total_winnings'],
                         'final_tax' => $val['final_tax'],
                         'net_winnings' => $val['net_winnings'],
                    ];
                }
                break;
            default:
                //DEFAULT- DAILY
                 $groupDate = $collectionTable->groupBy('year')->map(function($peryear){
                    return [ 'amount' => $peryear->sum('bet_amount'), 
                    'sum_amount' => $peryear->sum('bet_amount') * 0.5,
                    'grb' => $this->getTaxComputations($peryear->sum('bet_amount'),'grb'),
                    'vat' => $this->getTaxComputations($peryear->sum('bet_amount'),'vat'),
                    'total-grb' => $this->getTaxComputations($peryear->sum('bet_amount'),'total-grb'),
                    'total-grb' => $this->getTaxComputations($peryear->sum('bet_amount'),'total-grb'),
                    'basis-gr' => $this->getTaxComputations($peryear->sum('bet_amount'),'basis-gr'),
                    'basis-bets' => $this->getTaxComputations($peryear->sum('bet_amount'),'basis-bets'),
                    // NET COMMISSION
                    'gr_basis_gc' => $this->getTaxComputations($peryear->sum('bet_amount'),'gr_basis_gc'),
                    'gr_basis_with_holding' => $this->getTaxComputations($peryear->sum('bet_amount'),'gr_basis_with_holding'),
                    'gr_basis_nc' => $this->getTaxComputations($peryear->sum('bet_amount'),'gr_basis_nc'),
                    'tb_basis_gc' => $this->getTaxComputations($peryear->sum('bet_amount'),'tb_basis_gc'),
                    'tb_basis_with_holding' => $this->getTaxComputations($peryear->sum('bet_amount'),'tb_basis_with_holding'),
                    'tb_basis_nc' => $this->getTaxComputations($peryear->sum('bet_amount'),'tb_basis_nc'),
                     //FINAL TAX
                     'total_winnings' => $this->getTaxComputations($peryear->sum('bet_amount'),'total_winnings'),
                     'final_tax' => $this->getTaxComputations($peryear->sum('bet_amount'),'final_tax'),
                     'net_winnings' => $this->getTaxComputations($peryear->sum('bet_amount'),'net_winnings'),
                ];
                });
                // create array format to show date and count for table rows
                foreach($groupDate as $key => $val){
                    $rows[] = [
                        'date'      => $key,
                        'amount'    => '₱ '.number_format($val['amount'] ?? null,2),
                        'sum'       => '₱ '.number_format($val['sum_amount'] ?? null,2),
                        'grb'       =>  $val['grb'],
                        'vat'       =>  $val['vat'],
                        'total-grb' =>  $val['total-grb'],
                        'basis-gr'  =>  $val['basis-gr'],
                        'basis-bets'=>  $val['basis-bets'],
                        // NET COMMISSION
                        'gr_basis_gc' => $valCount['gr_basis_gc'],
                        'gr_basis_with_holding' => $valCount['gr_basis_with_holding'],
                        'gr_basis_nc' => $valCount['gr_basis_nc'],
                        'tb_basis_gc' => $valCount['tb_basis_gc'],
                        'tb_basis_with_holding' => $valCount['tb_basis_with_holding'],
                        'tb_basis_nc' => $valCount['tb_basis_nc'],
                        // FINAL TAX
                        'total_winnings' => $valCount['total_winnings'],
                        'final_tax' => $valCount['final_tax'],
                        'net_winnings' => $valCount['net_winnings'],
                    ];
                }
            break;
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

   
    public function getTaxData($request,$type,$tax = null){


        $data = DB::table('bets as bet')
        ->leftJoin('fights as fight', 'fight.id', '=', 'bet.fight_id')
        ->leftJoin('arenas as arena', 'arena.id', '=', 'fight.arena_id')
        ->leftJoin('users as user', 'user.id', '=', 'bet.player_id')
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

        if($tax == 'final-tax'){
            $data->where('result','WINNING');
        }

        if($type == 'table'){
            
            $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
            $order      =    $request->input('order', 'desc');
        
            $data->when($sort, function($query, $sort) use ($order){
                return $query->orderBy('bet.'.$sort, $order);
            });
        }

        $data = $this->getCollectionData($data,$tax);
        return $data;
    }

    public function getCollectionData($data,$tax){

        $query       =    [];
        
        foreach($data->get() as $key => $val){
           
            if($tax == 'final-tax'){
                $query[$key] = [
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
                    "bet_amount"    => $val->prize ?? null,
                    "bet_date"      => $val->bet_date ?? $val->schedule,
                ];
            }else{
                $query[$key] = [
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
        }
        $collection = collect($query);
        return $collection;
    }

    public function getTaxComputations($tb,$tax_type){
        
        bcscale(4);
        $grb = [
            'tb' => $tb,
            'grb' => bcmul($tb, '0.05')
        ];

        $gr = bcdiv($grb['grb'], '1.12');
        $vat = bcmul($gr, '.12');
        $grb_breakdown = [
            'gr' => $gr,
            'vat' => $vat,
            'total_grb' => bcadd($gr,$vat)
        ];
        
        $on_gc = [
            'gr' => bcmul($gr, '.02'),
            'tb' => bcmul($tb, '.02'),
        ];

        $gr_withholding = bcmul($on_gc['gr'],'0.1');
        $tb_withholding = bcmul($on_gc['tb'],'0.1');
        $on_nc = [
            'gr' => [
                'gc' => $on_gc['gr'],
                'withholding' => $gr_withholding,
                'nc' => bcsub($on_gc['gr'], $gr_withholding)
            ],
            'tb' => [
                'gc' => $on_gc['tb'],
                'withholding' => $tb_withholding,
                'nc' => bcsub($on_gc['tb'], $tb_withholding)
            ],
        ];

        $finalTax = [
            'tw' => $tb,
            'ft' => bcmul($tb, '0.2'),
            'nw' => bcadd($tb,bcmul($tb, '0.2'))
        ];

        switch($tax_type){
            case 'grb';
                return moneyFormat($grb_breakdown['gr'], 4);
            break;
            case 'vat';
                return moneyFormat($grb_breakdown['vat'], 4);
            break;
            case 'total-grb';
                return moneyFormat($grb_breakdown['total_grb'], 4);
            break;
            case 'basis-gr';
                return moneyFormat($on_gc['gr'], 4);
            break;
            case 'basis-bets';
                return moneyFormat($on_gc['tb'], 4);
            break;
            case 'gr_basis_gc';
                return moneyFormat($on_nc['gr']['gc'], 4);
            break;
             case 'gr_basis_with_holding';
                return moneyFormat($on_nc['gr']['withholding'], 4);
            break;
            case 'gr_basis_nc';
                return moneyFormat($on_nc['gr']['nc'], 4);
            break;
            case 'tb_basis_gc';
                return moneyFormat($on_nc['tb']['gc'], 4);
            break;
            case 'tb_basis_with_holding';
                return moneyFormat($on_nc['tb']['withholding'], 4);
            break;
            case 'tb_basis_nc';
                return moneyFormat($on_nc['tb']['nc'], 4);
            break;
            case 'total_winnings';
                return moneyFormat($finalTax['tw'], 4);
            break;
            case 'final_tax';
                return moneyFormat($finalTax['ft'], 4);
            break;
            case 'net_winnings';
                return moneyFormat($finalTax['nw'], 4);
            break;
            default;
                return '₱0.00';
            break;
        }
    }  
}