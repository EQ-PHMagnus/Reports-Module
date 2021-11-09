<?php
namespace App\Http\Traits;
use DB;

trait TransactionalData {
    public function getBets($request,$format){
        $type            = $request->input('filters.group') ?? $request->input('group');  // select type if daily/montly/yearly
        $limit           = intval($request->input('limit', 10));                          // pagination
        $offset          = intval($request->input('offset', 0));                          // pagination
        $collectionTable = $this->getBetData($request, 'table');
        $rows            = [];                                                            // all array result to be display in data tables
        $sort            = request()->input('sort');
        $order          = request()->input('order', 'desc');
        $search          = request()->input('search') ?? '';

        $searchable_cols = ['user.username', 'arena.name'];

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
            return $query->orderBy('trans.'.$sort, $order);
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

    // public function getFights($request,$format){

    //     $type               =    $request->input('filters.group') ?? $request->input('group'); // select type if daily/montly/yearly
    //     $limit              =    intval($request->input('limit', 10)); // pagination
    //     $offset             =    intval($request->input('offset', 0)); // pagination
    //     $collectionTable    =    $this->getFightData($request,'table'); 
    //     $rows               =    []; // all array result to be display in data tables
    //     $yearCount          =    [];
    //     $monthYearCount     =    [];
    //     $yearAmount         =    [];
    //     $monthYearAmount    =    [];

    //     // filter collections group by daily/monthly/yearly
    //     switch($type){
    //         case 'daily':
    //             $groupDate = $collectionTable->groupBy('arena')->map(function($data,$year){
    //                 return $data->groupBy('full_date')->map(function($perday){
    //                    return [ 'count' => $perday->count(), 'amount' => $perday->sum('bet_amount')];
    //                 });
    //             });   
    //             // create array format to show date and count for table rows
    //             foreach($groupDate as $key => $val){
    //                 foreach($val as $keyDate => $valCount){
                   
    //                     $rows[] = [
    //                         'date'  => $keyDate,
    //                         'count' => $valCount['count'],
    //                         'sum'   => '₱ '.number_format($valCount['amount'],2)
    //                     ];
    //                 }
    //             }
    //             break;
    //         case 'monthly';

           
    //             $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
    //                 return $data->groupBy('month_and_year')->map(function($permonth){
    //                     return [ 'count' => $permonth->count(), 'amount' => $permonth->sum('bet_amount')];
    //                 });
    //             });
    //             // create array format to show date and count for table rows
    //             foreach($groupDate as $key => $val){
    //                 foreach($val as $keyDate => $valCount){
    //                     $rows[] = [
    //                         'date'  => $keyDate,
    //                         'count' => $valCount['count'] ?? null,
    //                         'sum'   => '₱ '.number_format($valCount['amount'] ?? null,2)
    //                     ];
    //                 }
    //             }
    //             break;
    //         case 'yearly';
            
    //             $groupDate = $collectionTable->groupBy('year')->map(function($peryear){
    //                 return [ 'count' => $peryear->count(), 'amount' => $peryear->sum('bet_amount')];
    //             });
    //             // create array format to show date and count for table rows
    //             foreach($groupDate as $key => $val){
    //                 $rows[] = [
    //                     'date'  => $key,
    //                     'count' => $val['count'],
    //                     'sum'   => '₱ '.number_format($val['amount'] ?? null,2)
    //                 ];
    //             }
    //             break;
    //         default:
    //             $groupDate = $collectionTable->groupBy('year')->map(function($data,$year){
    //                 return $data->groupBy('month_and_day')->map(function($perday){
    //                     return [ 'count' => $perday->count(), 'amount' => $perday->sum('bet_amount')];
    //                 });
    //             }); 
    //             // create array format to show date and count for table rows
    //             foreach($groupDate as $key => $val){
    //                 foreach($val as $keyDate => $valCount){
    //                     $rows[] = [
    //                         'date'  => $keyDate.', '.$key,
    //                         'count' => $valCount['count'],
    //                         'sum'   => '₱ '.number_format($valCount['amount'],2)
    //                     ];
    //                 }
    //             }
    //     }

    //     if($format == 'excel'){
    //         return $rows;
    //     }
 
    //     //determine offset and limit of rows for pagination
    //     $result      = array_slice($rows,intval($request->input('offset', 0)),intval($request->input('limit', 10)));
    //     $countRows   = count($rows);

    //     return [
    //         'rows'                  =>   $result,
    //         'total'                 =>   $countRows,
    //         'totalNotFiltered'      =>   $countRows,
    //     ];
    // }

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
            user.name as name,
            fight.schedule as fight_schedule,
            fight.fight_no as fight_no,
            user.username as affiliate_name
        ')
        ->whereNull('bet.deleted_at');
       
        if($type == 'table'){
           
            $sort       =    $request->input('sort') == "" ? 'created_at' : $request->input('sort');
            $order      =    $request->input('order', 'desc');
           
            $data->when($sort, function($query, $sort) use ($order){
                return $query->orderBy('bet.'.$sort, $order);
            });
            return $data;
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
         
            $data->when($sort, function($query, $sort) use ($order){
                return $query->orderBy('fight.'.$sort, $order);
            });

        }

        $data = $this->getCollectionData($data);

        return $data;
    }

    public function getCollectionData($data){

        $query       =    [];
        
        foreach($data->get() as $key => $val){
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
        $collection = collect($query);
        return $collection;
    }

    
}