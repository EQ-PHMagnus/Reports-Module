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
}