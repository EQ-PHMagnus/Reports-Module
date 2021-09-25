<?php
namespace App\Http\Traits;
use DB;
trait Bets {

	public function getBetData(){

        $bets = [];

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
        ->whereNull('bet.deleted_at')
        ->get();


        foreach($data as $key => $val){
            
            $bets[$key] = [
                'year'          => date('Y', strtotime($val->bet_date)),
                'month'         => date('F', strtotime($val->bet_date)),
                'day'           => date('j', strtotime($val->bet_date)),
                'month_and_day' => date('F', strtotime($val->bet_date)).' '.date('j', strtotime($val->bet_date)),
                'time'          => date('H:i:s', strtotime($val->bet_date)),
                'arena'         => $val->arena,
                'fight_no'      => $val->fight_no,
                'account'       => $val->name,
                "pick"          => $val->pick,
                "odds"          => $val->odds,
                "bet_amount"    => $val->amount,
                "prize"         => $val->prize,
                "result"        => $val->result,
                "bet_date"      => $val->bet_date,
                "result_date"   => $val->result_date,

            ];
        }

        $collection = collect($bets);
        
        return $collection;
    }

    public function showTotalBets($bets,$view,$dashboardView){

        
        $totalBetsPerYear       = $bets->groupBy('year')->map->count();
        $totalAmountBetsPerYear = $bets->groupBy('year')->map(function($perYear){
            return $perYear->sum('bet_amount');
        });

        
        $totalAmountBetsPerArena = $bets->groupBy('arena')->map(function($perYear){
            return $perYear->sum('bet_amount');
        });

        $totalNumberBetsPerMonth = $bets->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month')->map(function($permonth){
                return $permonth->count();
             });
        });
      
        $totalNumberBetsPerDay = $bets->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month_and_day')->map(function($permonth){
                return $permonth->count();
             });
        });

        $totalNumberBetsPerArena        = $bets->groupBy('arena')->map->count();
        
        $yearAndTotalAmountBetsPerMonth = $bets->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month')->map(function($permonth){
                return $permonth->sum('bet_amount');
             });
        });

        $yearAndTotalAmountBetsPerDay = $bets->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month_and_day')->map(function($permonth){
                return $permonth->sum('bet_amount');
             });
        });

        if($dashboardView == true){
            
            $totalBetsPerYear = $this->formatBar($totalBetsPerYear);
            $totalAmountBetsPerYear = $this->formatBar($totalAmountBetsPerYear);
            $totalAmountBetsPerArena = $this->formatBar($totalAmountBetsPerArena);

            $totalNumberBetsPerMonth = $this->formatLine($totalNumberBetsPerMonth);
            $totalNumberBetsPerDay = $this->formatLine($totalNumberBetsPerDay);
            $yearAndTotalAmountBetsPerMonth = $this->formatLine($yearAndTotalAmountBetsPerMonth);
            $yearAndTotalAmountBetsPerDay = $this->formatLine($yearAndTotalAmountBetsPerDay);
            
            $totalNumberBetsPerArena = $this->formatPie($totalNumberBetsPerArena);
            
            $view = 'dashboard.finance.total-bets';
        }

        // dd($yearAndTotalAmountBetsPerDay);
        return view($view,compact(

            'bets',
            'totalAmountBetsPerYear',
            'totalAmountBetsPerArena',
            'yearAndTotalAmountBetsPerMonth',
            'yearAndTotalAmountBetsPerDay',
            'totalNumberBetsPerMonth',
            'totalBetsPerYear',
            'totalNumberBetsPerDay',
            'totalNumberBetsPerArena',
            
        ));
    }
}