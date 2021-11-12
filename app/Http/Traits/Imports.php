<?php
namespace App\Http\Traits;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Bet;
use App\Models\Fight;
use DB;

trait Imports {

    public function uploadFile($request){
       
        // save uploaded file to database if file exists
        if($request->hasFile('bets')){
            $file    = $request->file('bets');
            $upFile  = getUploadedFile($file);
            $bets    = (new FastExcel)->import($upFile, function ($line) {
                return Bet::create([
                    'fight_id' => $line['fight_id'],
                    'player_id'  => $line['player_id'],
                    'pick'     => $line['pick'],
                    'odds'     => $line['odds'],
                    'amount'   => $line['amount'],
                    'prize'    => $line['prize'],
                    'result'   => $line['result'],
                    'bet_date' => $line['bet_date'],
                    'result_date' => $line['result_date']
                ]);
            });
        }
        // save uploaded file to database if file exists
        if($request->hasFile('fights')){
            $file    = $request->file('fights');
            $upFile  = getUploadedFile($file);
            $fights  = (new FastExcel)->import($upFile, function ($line) {
                return Fight::create([
                    'arena_id' => $line['arena_id'],
                    'fight_no' => $line['fight_no'],
                    'meron'    => $line['meron'],
                    'meron_lb' => $line['meron_lb'],
                    'meron_wb' => $line['meron_wb'],
                    'meron_wt' => $line['meron_wt'],
                    'wala'     => $line['wala'],
                    'wala_lb'  => $line['wala_lb'],
                    'wala_wt'  => $line['wala_wt'],
                    'schedule' => $line['schedule']
                ]);
            });
        }


    }
}