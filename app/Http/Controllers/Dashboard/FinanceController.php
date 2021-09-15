<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function totalBets(){
        $tableView = request()->input('view',null) == 'table';

        $bets = collect();
        $data = collect([
            ['2020', 'January', '1', 'January 1', '14:08:01', 'Arena 1', '5', 'admin', 'MERON', '0', '₱300.00', '₱0.00', 'WATING', '2021-08-24 14:08:01', ''],
            ['2020', 'January', '1', 'January 1', '11:55:57', 'Arena 2', '4', 'janeroe', 'WALA', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:57', '2021-08-23 11:56:03'],
            ['2020', 'March', '23', 'March 23', '11:55:48', 'Arena 3', '4', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:48', '2021-08-23 11:56:03'],
            ['2020', 'March', '23', 'March 23', '11:43:31', 'Arena 4', '2', 'janeroe', 'WALA', '2.13', '₱300.00', '₱639.00', 'WINNING', '2021-08-23 11:43:31', '2021-08-23 11:45:20'],
            ['2021', 'January', '1', 'January 1', '14:08:01', 'Arena 5', '5', 'admin', 'MERON', '0', '₱300.00', '₱0.00', 'WATING', '2021-08-24 14:08:01', ''],
            ['2021', 'January', '1', 'January 1', '11:55:57', 'Arena 6', '4', 'janeroe', 'WALA', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:57', ''],
            ['2021', 'March', '23', 'March 23', '11:55:48', 'Arena 1', '4', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:48', ''],
            ['2021', 'March', '23', 'March 23', '11:43:31', 'Arena 2', '2', 'janeroe', 'WALA', '2.13', '₱300.00', '₱639.00', 'WINNING', '2021-08-23 11:43:31', ''],
            ['2021', 'March', '23', 'March 23', '11:43:31', 'Arena 5', '2', 'janeroe', 'WALA', '2.13', '₱300.00', '₱639.00', 'WINNING', '2021-08-23 11:43:31', ''],
            ['2020', 'August', '24', 'August 24', '14:08:01', 'Arena 4', '1', 'admin', 'MERON', '0', '₱300.00', '₱0.00', 'WATING', '2021-08-24 14:08:01', ''],
            ['2021', 'August', '24', 'August 24', '14:08:01', 'Arena 4', '1', 'admin', 'MERON', '0', '₱300.00', '₱0.00', 'WATING', '2021-08-24 14:08:01', ''],
            ['2021', 'August', '24', 'August 24', '14:08:01', 'Arena 4', '1', 'admin', 'MERON', '0', '₱300.00', '₱0.00', 'WATING', '2021-08-24 14:08:01', ''],
            ['2021', 'August', '23', 'August 23', '11:55:57', 'Arena 5', '4', 'janeroe', 'WALA', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:57', '2021-08-23 11:56:03'],
            ['2021', 'August', '23', 'August 23', '11:55:48', 'Arena 6', '4', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:48', '2021-08-23 11:56:03'],
            ['2021', 'August', '23', 'August 23', '11:43:31', 'Arena 5', '2', 'janeroe', 'WALA', '2.13', '₱300.00', '₱639.00', 'WINNING', '2021-08-23 11:43:31', '2021-08-23 11:45:20'],
            ['2021', 'August', '23', 'August 23', '11:43:21', 'Arena 2', '2', 'janeroe', 'MERON', '0', '₱1,000.00', '₱0.00', 'DEFEATED', '2021-08-23 11:43:21', '2021-08-23 11:45:20'],
            ['2021', 'August', '23', 'August 23', '11:43:13', 'Arena 3', '2', 'janeroe', 'WALA', '2.13', '₱500.00', '₱1,065.00', 'WINNING', '2021-08-23 11:43:13', '2021-08-23 11:45:20'],
            ['2020', 'August', '23', 'August 23', '11:38:01', 'Arena 4', '1', 'janeroe', 'MERON', '0', '₱1,000.00', '₱0.00', 'DEFEATED', '2021-08-23 11:38:01', '2021-08-23 11:39:42'],
            ['2020', 'August', '23', 'August 23', '11:37:56', 'Arena 5', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', 'WINNING', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
            ['2020', 'August', '23', 'August 23', '11:43:31', 'Arena 1', '2', 'janeroe', 'WALA', '2.13', '₱300.00', '₱639.00', 'WINNING', '2021-08-23 11:43:31', '2021-08-23 11:45:20'],
            ['2020', 'August', '23', 'August 23', '11:43:21', 'Arena 2', '2', 'janeroe', 'MERON', '0', '₱1,000.00', '₱0.00', 'DEFEATED', '2021-08-23 11:43:21', '2021-08-23 11:45:20'],
            ['2020', 'August', '23', 'August 23', '11:43:13', 'Arena 3', '2', 'janeroe', 'WALA', '2.13', '₱500.00', '₱1,065.00', 'WINNING', '2021-08-23 11:43:13', '2021-08-23 11:45:20'],
            ['2020', 'August', '23', 'August 23', '11:38:01', 'Arena 4', '1', 'janeroe', 'MERON', '0', '₱1,000.00', '₱0.00', 'DEFEATED', '2021-08-23 11:38:01', '2021-08-23 11:39:42'],
            ['2021', 'August', '23', 'August 23', '11:37:56', 'Arena 5', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', 'WINNING', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
            ['2021', 'August', '23', 'August 23', '11:37:51', 'Arena 6', '1', 'janeroe', 'MERON', '0', '₱100.00', '₱0.00', 'DEFEATED', '2021-08-23 11:37:51', '2021-08-23 11:39:42'],
            ['2021', 'August', '23', 'August 23', '11:37:46', 'Arena 1', '1', 'janeroe', 'WALA', '1.21', '₱100.00', '₱121.00', 'WINNING', '2021-08-23 11:37:46', '2021-08-23 11:39:42'],
            ['2021', 'August', '23', 'August 23', '11:37:39', 'Arena 2', '1', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:37:39', '2021-08-23 11:39:42'],
            ['2021', 'August', '23', 'August 23', '11:37:31', 'Arena 3', '1', 'janeroe', 'DRAW', '0', '₱100.00', '₱0.00', 'DEFEATED', '2021-08-23 11:37:31', '2021-08-23 11:39:42'],
            ['2020', 'August', '19', 'August 19', '9:33:03', 'Arena 4', '3', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-19 9:33:03', '2021-08-19 9:35:17'],
            ['2021', 'August', '19', 'August 19', '9:32:46', 'Arena 5', '3', 'janeroe', 'WALA', '1.52', '₱500.00', '₱760.00', 'WINNING', '2021-08-19 9:32:46', '2021-08-19 9:35:17'],
        ]);
        
        foreach ($data as $key => $row) {
            $bet_amount = str_replace('₱', '', $row[10]);
            $bet_amount = str_replace(',', '', $bet_amount);
            $prize = str_replace('₱', '', $row[11]);
            $prize = str_replace(',', '', $prize);

            $bets->push([
                'year' => $row[0],
                'month' => $row[1],
                'day' => $row[2],
                'month_and_day' => $row[3],
                'time' => $row[4],
                'arena' => $row[5],
                'fight_no' => $row[6],
                'account' => $row[7],
                'pick' => $row[8],
                'odds' =>(float) $row[9],
                'bet_amount' => (float) $bet_amount,
                'prize' => (float) $prize,
                'result' => $row[12],
                'bet_date' => $row[13],
                'result_date' => $row[14],
            ]) ;
        }

        $totalBetsPerYear = $bets->groupBy('year')->map->count();
        $totalAmountBetsPerYear = $bets->groupBy('year')->map(function($perYear){
            return $perYear->sum('bet_amount');
        });

        $totalAmountBetsPerArena = $bets->groupBy('arena')->map(function($perYear){
            return $perYear->sum('bet_amount');
        });

        $totalNumberBetsPerMonthData = $bets->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month')->map(function($permonth){
                return $permonth->count();
             });
        });

        $totalNumberBetsPerDayData = $bets->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month_and_day')->map(function($permonth){
                return $permonth->count();
             });
        });

        $totalNumberBetsPerArenaData = $bets->groupBy('arena')->map->count();

        $yearAndTotalAmountBetsPerMonthData = $bets->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month')->map(function($permonth){
                return $permonth->sum('bet_amount');
             });
        });

        $yearAndTotalAmountBetsPerDayData = $bets->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month_and_day')->map(function($permonth){
                return $permonth->sum('bet_amount');
             });
        });
        if($tableView == false){
            $totalNumberBetsPerMonth = [
                'labels' => [],
                'series' => []
            ];

            foreach($totalNumberBetsPerMonthData as $year => $perYearData ){
                $subSeries = [];
                foreach($perYearData as $month => $perMonthData){   
                if(!in_array($month, $totalNumberBetsPerMonth['labels']))
                    $totalNumberBetsPerMonth['labels'][] = $month;
                    $subSeries[] = $perMonthData;
                }
                 $totalNumberBetsPerMonth['series'][] = $subSeries;   
            }

            $totalNumberBetsPerDay = [
                'labels' => [],
                'series' => []
            ];
            
            

            foreach($totalNumberBetsPerDayData as $year => $perYearData ){
                $subSeries = [];
                foreach($perYearData as $day => $perMonthData){   
                if(!in_array($day, $totalNumberBetsPerDay['labels']))
                    $totalNumberBetsPerDay['labels'][] = $day;
                    $subSeries[] = $perMonthData;
                }
                 $totalNumberBetsPerDay['series'][] = $subSeries;   
            }

            $totalNumberBetsPerArena = [
                'labels' => [],
                'series' => []
            ];
            
            
            foreach($totalNumberBetsPerArenaData as $arena => $count ){
                if(!in_array($arena, $totalNumberBetsPerArena['labels'])){
                    $totalNumberBetsPerArena['labels'][] = $arena;
                    $totalNumberBetsPerArena['series'][] = $count;   
                }
            }
            

            $yearAndTotalAmountBetsPerMonth = [
                'labels' => [],
                'series' => []
            ];
            
            

            foreach($yearAndTotalAmountBetsPerMonthData as $year => $perYearData ){
                $subSeries = [];
                foreach($perYearData as $month => $perMonthData){   
                if(!in_array($month, $yearAndTotalAmountBetsPerMonth['labels']))
                    $yearAndTotalAmountBetsPerMonth['labels'][] = $month;
                    $subSeries[] = $perMonthData;
                }
                 $yearAndTotalAmountBetsPerMonth['series'][] = $subSeries;   
            }

            $yearAndTotalAmountBetsPerDay = [
                'labels' => [],
                'series' => []
            ];
            
            

            foreach($yearAndTotalAmountBetsPerDayData as $year => $perYearData ){
                $subSeries = [];
                foreach($perYearData as $day => $perMonthData){   
                if(!in_array($day, $yearAndTotalAmountBetsPerDay['labels']))
                    $yearAndTotalAmountBetsPerDay['labels'][] = $day;
                    $subSeries[] = $perMonthData;
                }
                 $yearAndTotalAmountBetsPerDay['series'][] = $subSeries;   
            }
            // dd($totalNumberBetsPerDay,$bets);
            return view('dashboard.finance.total-bets',compact(
                'totalAmountBetsPerYear',
                'totalAmountBetsPerArena',
                'yearAndTotalAmountBetsPerMonth',
                'yearAndTotalAmountBetsPerDay',
                'totalNumberBetsPerMonth',
                'totalBetsPerYear',
                'totalNumberBetsPerDay',
                'totalNumberBetsPerArena'
            ));
        }else{
            return view('tables.finance.total-bets',compact(
                'bets',
                'totalAmountBetsPerYear',
                'totalAmountBetsPerArena',
                'yearAndTotalAmountBetsPerMonthData',
                'yearAndTotalAmountBetsPerDayData',
                'totalNumberBetsPerMonthData',
                'totalBetsPerYear',
                'totalNumberBetsPerDayData',
                'totalNumberBetsPerArenaData'
            ));
        }
    }

    public function totalFights()
    {
        $fights = collect();
        $data = collect([
                ['2020', 'January', '1', 'January 1', '14:08:01', 'Arena 1', '5', 'admin', 'MERON', '0', '₱300.00', '₱0.00', 'WATING', '2021-08-24 14:08:01', ''],
                ['2020', 'January', '1', 'January 1', '11:55:57', 'Arena 2', '4', 'janeroe', 'WALA', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:57', '2021-08-23 11:56:03'],
                ['2020', 'March', '23', 'March 23', '11:55:48', 'Arena 3', '4', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:48', '2021-08-23 11:56:03'],
                ['2020', 'March', '23', 'March 23', '11:43:31', 'Arena 4', '2', 'janeroe', 'WALA', '2.13', '₱300.00', '₱639.00', 'WINNING', '2021-08-23 11:43:31', '2021-08-23 11:45:20'],
                ['2021', 'January', '1', 'January 1', '14:08:01', 'Arena 5', '1', 'admin', 'MERON', '0', '₱300.00', '₱0.00', 'WATING', '2021-08-24 14:08:01', ''],
                ['2021', 'January', '1', 'January 1', '11:37:46', 'Arena 6', '1', 'janeroe', 'WALA', '1.21', '₱100.00', '₱121.00', 'WINNING', '2021-08-23 11:37:46', '2021-08-23 11:39:42'],
                ['2021', 'March', '23', 'March 23', '11:55:57', 'Arena 1', '4', 'janeroe', 'WALA', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:57', '2021-08-23 11:56:03'],
                ['2021', 'March', '23', 'March 23', '11:55:48', 'Arena 2', '4', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:48', '2021-08-23 11:56:03'],
                ['2021', 'March', '23', 'March 23', '11:55:48', 'Arena 5', '4', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:55:48', '2021-08-23 11:56:03'],
                ['2020', 'August', '24', 'August 24', '11:43:31', 'Arena 4', '2', 'janeroe', 'WALA', '2.13', '₱300.00', '₱639.00', 'WINNING', '2021-08-23 11:43:31', '2021-08-23 11:45:20'],
                ['2021', 'August', '24', 'August 24', '11:43:21', 'Arena 4', '2', 'janeroe', 'MERON', '0', '₱1,000.00', '₱0.00', 'DEFEATED', '2021-08-23 11:43:21', '2021-08-23 11:45:20'],
                ['2021', 'August', '24', 'August 24', '11:43:13', 'Arena 4', '2', 'janeroe', 'WALA', '2.13', '₱500.00', '₱1,065.00', 'WINNING', '2021-08-23 11:43:13', '2021-08-23 11:45:20'],
                ['2021', 'August', '23', 'August 23', '11:38:01', 'Arena 5', '1', 'janeroe', 'MERON', '0', '₱1,000.00', '₱0.00', 'DEFEATED', '2021-08-23 11:38:01', '2021-08-23 11:39:42'],
                ['2021', 'August', '23', 'August 23', '11:38:01', 'Arena 6', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', 'WINNING', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2021', 'August', '23', 'August 23', '11:38:01', 'Arena 5', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', 'DEFEATED', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2021', 'August', '23', 'August 23', '11:38:01', 'Arena 2', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', 'DEFEATED', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2021', 'August', '23', 'August 23', '11:38:01', 'Arena 3', '1', 'janeroe', 'MERON', '1.21', '₱300.00', '₱6,050.00', 'DEFEATED', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2020', 'August', '23', 'August 23', '11:38:01', 'Arena 4', '1', 'janeroe', 'MERON', '1.21', '₱300.00', '₱6,050.00', 'WINNING', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2020', 'August', '23', 'August 23', '11:38:01', 'Arena 5', '1', 'janeroe', 'MERON', '1.21', '₱300.00', '₱6,050.00', 'WINNING', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2020', 'August', '23', 'August 23', '11:38:01', 'Arena 1', '1', 'janeroe', 'MERON', '1.21', '₱5,000.00', '₱6,050.00', 'WINNING', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2020', 'August', '23', 'August 23', '11:38:01', 'Arena 2', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', 'DEFEATED', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2020', 'August', '23', 'August 23', '11:38:01', 'Arena 3', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', 'DEFEATED', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2020', 'August', '23', 'August 23', '11:38:01', 'Arena 4', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', 'DEFEATED', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2021', 'August', '23', 'August 23', '11:38:01', 'Arena 5', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', 'WINNING', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
                ['2021', 'August', '23', 'August 23', '11:37:46', 'Arena 6', '1', 'janeroe', 'WALA', '1.21', '₱100.00', '₱121.00', 'WINNING', '2021-08-23 11:37:46', '2021-08-23 11:39:42'],
                ['2021', 'August', '23', 'August 23', '11:37:39', 'Arena 1', '1', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-23 11:37:39', '2021-08-23 11:39:42'],
                ['2021', 'August', '23', 'August 23', '11:37:31', 'Arena 2', '1', 'janeroe', 'DRAW', '0', '₱100.00', '₱0.00', 'DEFEATED', '2021-08-23 11:37:31', '2021-08-23 11:39:42'],
                ['2021', 'August', '23', 'August 23', '9:33:03', 'Arena 3', '3', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', 'DEFEATED', '2021-08-19 9:33:03', '2021-08-19 9:35:17'],
                ['2020', 'August', '19', 'August 19', '9:32:46', 'Arena 4', '3', 'janeroe', 'WALA', '1.52', '₱500.00', '₱760.00', 'WINNING', '2021-08-19 9:32:46', '2021-08-19 9:35:17'],
                ['2021', 'August', '19', 'August 19', '14:08:01', 'Arena 5', '5', 'admin', 'MERON', '0', '₱300.00', '₱0.00', 'WATING', '2021-08-24 14:08:01', ''],
        ]);

        foreach ($data as $key => $row) {
            $bet_amount = str_replace('₱', '', $row[10]);
            $bet_amount = str_replace(',', '', $bet_amount);
            $prize = str_replace('₱', '', $row[11]);
            $prize = str_replace(',', '', $prize);

            $fights->push([
                'year' => $row[0],
                'month' => $row[1],
                'day' => $row[2],
                'month_and_day' => $row[3],
                'time' => $row[4],
                'arena' => $row[5],
                'fight_no' => $row[6],
                'account' => $row[7],
                'pick' => $row[8],
                'odds' =>(float) $row[9],
                'bet_amount' => (float) $bet_amount,
                'prize' => (float) $prize,
                'result' => $row[12],
                'bet_date' => $row[13],
                'result_date' => $row[14],
            ]) ;
        }

        $totalFightsPerYear = $fights->groupBy('year')->map->count();

        $totalNumberFightsPerMonth = [
            'labels' => [],
            'series' => []
        ];
        
        $totalNumberFightsPerMonthData = $fights->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month')->map(function($permonth){
                return $permonth->count();
             });
        });

        foreach($totalNumberFightsPerMonthData as $year => $perYearData ){
            $subSeries = [];
            foreach($perYearData as $month => $perMonthData){   
            if(!in_array($month, $totalNumberFightsPerMonth['labels']))
                $totalNumberFightsPerMonth['labels'][] = $month;
                $subSeries[] = $perMonthData;
            }
             $totalNumberFightsPerMonth['series'][] = $subSeries;   
        }

        $totalNumberFightsPerDay = [
            'labels' => [],
            'series' => []
        ];
        
        $totalNumberFightsPerDayData = $fights->where('month','August')->groupBy('month_and_day')->map->count();
        $subSeries = [];
        foreach($totalNumberFightsPerDayData as $day => $count ){
            if(!in_array($day, $totalNumberFightsPerDay['labels'])){
                $totalNumberFightsPerDay['labels'][] = $day;
                $subSeries[] = $count;
            }
        }
        $totalNumberFightsPerDay['series'][] = $subSeries;   

        $totalNumberFightsPerArena = [
            'labels' => [],
            'series' => []
        ];
        
        $totalNumberFightsPerArenaData = $fights->groupBy('arena')->map->count();
        $subSeries = [];
        foreach($totalNumberFightsPerArenaData as $arena => $count ){
            if(!in_array($arena, $totalNumberFightsPerArena['labels'])){
                $totalNumberFightsPerArena['labels'][] = $arena;
                $subSeries[] = $count;
                
            }
        }
        $totalNumberFightsPerArena['series'][] = $subSeries;   
        return view('dashboard.finance.total-fights',compact(
            'totalFightsPerYear',
            'totalNumberFightsPerMonth',
            'totalNumberFightsPerDay',
            'totalNumberFightsPerArena'
        ));
    }

    public function magnusEarnings()
    {
        $fights = collect([]);
        $data = collect([
            ['2020', 'January', '1', 'Arena 1', '1', 'maryjane', 'DRAW', '1', '₱100.00', '₱100.00', '₱5.00', 'CANCELLED', '2021-08-26 14:43:47', '2021-08-26 16:48:32'],
            ['2020', 'January', '1', 'Arena 2', '1', 'janeroe', 'MERON', '1', '₱100.00', '₱100.00', '₱5.00', 'CANCELLED', '2021-08-26 14:43:22', '2021-08-26 16:48:32'],
            ['2020', 'March', '23', 'Arena 3', '1', 'admin', 'WALA', '1', '₱100.00', '₱100.00', '₱5.00', 'CANCELLED', '2021-08-24 14:08:18', '2021-08-26 16:48:32'],
            ['2020', 'March', '23', 'Arena 4', '1', 'admin', 'MERON', '1', '₱300.00', '₱300.00', '₱15.00', 'CANCELLED', '2021-08-24 14:08:01', '2021-08-26 16:48:32'],
            ['2020', 'August', '2', 'Arena 5', '4', 'janeroe', 'WALA', '0', '₱300.00', '₱500.00', '₱25.00', 'DEFEATED', '2021-08-23 11:55:57', '2021-08-23 11:56:03'],
            ['2020', 'August', '4', 'Arena 6', '11', 'janeroe', 'MERON', '0', '₱1,000.00', '₱100.00', '₱5.00', 'DEFEATED', '2021-08-18 20:30:33', '2021-08-18 20:31:18'],
            ['2020', 'August', '6', 'Arena 1', '10', 'janeroe', 'MERON', '1.58', '₱500.00', '₱790.00', '₱39.50', 'WINNING', '2021-08-18 20:29:18', '2021-08-18 20:29:31'],
            ['2020', 'August', '8', 'Arena 2', '10', 'janeroe', 'WALA', '0', '₱100.00', '₱90.00', '₱4.50', 'DEFEATED', '2021-08-18 20:29:12', '2021-08-18 20:29:31'],
            ['2020', 'August', '10', 'Arena 5', '10', 'janeroe', 'WALA', '0', '₱300.00', '₱200.00', '₱10.00', 'DEFEATED', '2021-08-18 20:29:06', '2021-08-18 20:29:31'],
            ['2020', 'August', '12', 'Arena 4', '10', 'salmonroe', 'MERON', '1.58', '₱100.00', '₱158.00', '₱7.90', 'WINNING', '2021-08-18 20:29:00', '2021-08-18 20:29:31'],
            ['2020', 'August', '14', 'Arena 4', '20', 'admin', 'MERON', '1', '₱100.00', '₱100.00', '₱5.00', 'CANCELLED', '2021-08-18 20:20:39', '2021-08-18 20:20:48'],
            ['2021', 'August', '16', 'Arena 4', '2', 'janeroe', 'WALA', '2.13', '₱300.00', '₱639.00', '₱31.95', 'WINNING', '2021-08-23 11:43:31', '2021-08-23 11:45:20'],
            ['2021', 'August', '23', 'Arena 5', '2', 'janeroe', 'MERON', '0', '₱1,000.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-23 11:43:21', '2021-08-23 11:45:20'],
            ['2021', 'August', '23', 'Arena 6', '2', 'maryjane', 'WALA', '2.13', '₱500.00', '₱1,065.00', '₱53.25', 'WINNING', '2021-08-23 11:43:13', '2021-08-23 11:45:20'],
            ['2021', 'August', '23', 'Arena 5', '1', 'janeroe', 'MERON', '0', '₱1,000.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-23 11:38:01', '2021-08-23 11:39:42'],
            ['2021', 'August', '23', 'Arena 2', '1', 'janeroe', 'WALA', '1.21', '₱5,000.00', '₱6,050.00', '₱302.50', 'WINNING', '2021-08-23 11:37:56', '2021-08-23 11:39:42'],
            ['2021', 'August', '23', 'Arena 3', '1', 'janeroe', 'MERON', '0', '₱100.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-23 11:37:51', '2021-08-23 11:39:42'],
            ['2021', 'August', '23', 'Arena 4', '1', 'maryjane', 'WALA', '1.21', '₱100.00', '₱121.00', '₱6.05', 'WINNING', '2021-08-23 11:37:46', '2021-08-23 11:39:42'],
            ['2021', 'September', '23', 'Arena 5', '1', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-23 11:37:39', '2021-08-23 11:39:42'],
            ['2021', 'September', '23', 'Arena 1', '1', 'janeroe', 'DRAW', '0', '₱100.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-23 11:37:31', '2021-08-23 11:39:42'],
            ['2021', 'September', '23', 'Arena 2', '3', 'maryjane', 'MERON', '0', '₱300.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-19 9:33:03', '2021-08-19 9:35:17'],
            ['2021', 'September', '23', 'Arena 3', '3', 'janeroe', 'WALA', '1.52', '₱500.00', '₱760.00', '₱38.00', 'WINNING', '2021-08-19 9:32:46', '2021-08-19 9:35:17'],
            ['2021', 'October', '23', 'Arena 4', '12', 'janeroe', 'WALA', '2.21', '₱300.00', '₱663.00', '₱33.15', 'WINNING', '2021-08-18 20:34:02', '2021-08-18 20:34:09'],
            ['2021', 'October', '23', 'Arena 5', '12', 'janeroe', 'MERON', '0', '₱100.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-18 20:33:56', '2021-08-18 20:34:09'],
            ['2021', 'October', '23', 'Arena 6', '12', 'janeroe', 'MERON', '0', '₱300.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-18 20:33:51', '2021-08-18 20:34:09'],
            ['2021', 'October', '23', 'Arena 1', '11', 'salmonroe', 'WALA', '1.9', '₱500.00', '₱950.00', '₱47.50', 'WINNING', '2021-08-18 20:31:09', '2021-08-18 20:31:18'],
            ['2021', 'October', '23', 'Arena 2', '11', 'janeroe', 'WALA', '1.9', '₱5,000.00', '₱9,500.00', '₱475.00', 'WINNING', '2021-08-18 20:30:57', '2021-08-18 20:31:18'],
            ['2021', 'October', '23', 'Arena 3', '11', 'salmonroe', 'MERON', '0', '₱5,000.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-18 20:30:45', '2021-08-18 20:31:18'],
            ['2021', 'October', '23', 'Arena 4', '11', 'janeroe', 'WALA', '1.9', '₱500.00', '₱950.00', '₱47.50', 'WINNING', '2021-08-18 20:30:39', '2021-08-18 20:31:18'],
            ['2021', 'November', '23', 'Arena 5', '11', 'janeroe', 'MERON', '0', '₱1,000.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-18 20:30:33', '2021-08-18 20:31:18'],
            ['2021', 'November', '23', 'Arena 6', '10', 'janeroe', 'MERON', '1.58', '₱500.00', '₱790.00', '₱39.50', 'WINNING', '2021-08-18 20:29:18', '2021-08-18 20:29:31'],
            ['2021', 'November', '23', 'Arena 1', '10', 'janeroe', 'WALA', '0', '₱100.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-18 20:29:12', '2021-08-18 20:29:31'],
            ['2021', 'November', '23', 'Arena 2', '10', 'janeroe', 'WALA', '0', '₱300.00', '₱0.00', '₱0.00', 'DEFEATED', '2021-08-18 20:29:06', '2021-08-18 20:29:31'],
            ['2021', 'December', '23', 'Arena 3', '10', 'salmonroe', 'MERON', '1.58', '₱100.00', '₱158.00', '₱7.90', 'WINNING', '2021-08-18 20:29:00', '2021-08-18 20:29:31'],
            ['2021', 'December', '23', 'Arena 4', '20', 'admin', 'MERON', '1', '₱100.00', '₱100.00', '₱5.00', 'CANCELLED', '2021-08-18 20:20:39', '2021-08-18 20:20:48'],
        ]);
        
         foreach ($data as $key => $row) {
            $bet_amount = str_replace('₱', '', $row[8]);
            $bet_amount = str_replace(',', '', $bet_amount);
            $prize = str_replace('₱', '', $row[9]);
            $prize = str_replace(',', '', $prize);
            $magnusEarnings = str_replace('₱', '', $row[10]);
            $magnusEarnings = str_replace(',', '', $magnusEarnings);
            $fights->push([
                'year' => $row[0],
                'month' => $row[1],
                'day' => $row[2],
                // 'month_and_day' => $row[3],
                // 'time' => $row[4],
                'arena' => $row[3],
                'fight_no' => $row[4],
                'account' => $row[5],
                'pick' => $row[6],
                'odds' =>(float) $row[7],
                'bet_amount' => (float) $bet_amount,
                'prize' => (float) $prize,
                'magnus_earnings' => (float) $magnusEarnings,
                'result' => $row[11],
                'bet_date' => $row[12],
                'result_date' => $row[13],
            ]) ;
        }
        // $fights = $fights->sortBy('year');
        $earningToday;

        $totalEarningsPerDay = [
            'labels' => [],
            'series' => []
        ];
        
        $totalEarningsPerDayData = $fights->where('month','August')
        // ->where('year','2021')
        ->groupBy('day')->map(function($data,$day){
             return $data->sum('magnus_earnings');
        });


        $subSeries = [];
        foreach($totalEarningsPerDayData as $day => $earningsPerDay ){
            $dayString = 'August ' . $day; 
            if(!in_array($dayString, $totalEarningsPerDay['labels'])){
                $totalEarningsPerDay['labels'][] = $dayString;
                $subSeries[] = $earningsPerDay;
            }  
        }
        $totalEarningsPerDay['series'][] = $subSeries;

        $totalEarningsPerMonth = [
            'labels' => [],
            'series' => []
        ];
        
        $totalEarningsPerMonthData = $fights->groupBy('year')
            ->map(function($perYear,$year){
                return $perYear->groupBy('month')->map(function($permonth) use ($year){
                   return $permonth->sum('magnus_earnings');
            });
        });       

        $subSeries = [];
         foreach($totalEarningsPerMonthData as $year => $perYearData ){
            foreach($perYearData as $month => $perMonthData){   
            $monthYear = $month . ' ' . $year;
            if(!in_array($monthYear, $totalEarningsPerMonth['labels']))
                $totalEarningsPerMonth['labels'][] = $monthYear;
                $subSeries[] = $perMonthData;
            }
        }
         $totalEarningsPerMonth['series'][] = $subSeries;   

        $totalEarningsPerYear = [
            'labels' => [],
            'series' => []
        ];
        
        $totalEarningsPerYearData = $fights->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month')->map(function($permonth){
                return $permonth->sum('magnus_earnings');
             });
        });

        foreach($totalEarningsPerYearData as $year => $perYearData ){
            $subSeries = [];
            foreach($perYearData as $month => $perMonthData){   
                if(!in_array($month, $totalEarningsPerYear['labels']))
                    $totalEarningsPerYear['labels'][] = $month;
                
                $subSeries[] = $perMonthData;
            }
            $totalEarningsPerYear['series'][] = $subSeries;   
        }


        $totalEarningsPerArena = [
            'labels' => [],
            'series' => []
        ];
        
        $totalEarningsPerArenaData = $fights->groupBy('arena')->map->sum('magnus_earnings');
        $subSeries = [];
        foreach($totalEarningsPerArenaData as $arena => $count ){
            if(!in_array($arena, $totalEarningsPerArena['labels'])){
                $totalEarningsPerArena['labels'][] = $arena;
                $subSeries[] = $count;
            }
        }

        $totalEarningsPerArena['series'][] = $subSeries;

        $totalEarningsPerFight = [
            'labels' => [],
            'series' => []
        ];
        
        $totalEarningsPerFightData = $fights->groupBy('fight_no')->map->sum('magnus_earnings');
        $subSeries = [];
        foreach($totalEarningsPerFightData as $fightNo => $count ){
            if(!in_array($fightNo, $totalEarningsPerFight['labels'])){
                $totalEarningsPerFight['labels'][] = $fightNo;
                $subSeries[] = $count;
            }
        }
        $totalEarningsPerFight['series'][] = $subSeries;


        return view('dashboard.finance.magnus-earnings',compact(
            'totalEarningsPerDay',
            'totalEarningsPerMonth',
            'totalEarningsPerYear',
            'totalEarningsPerArena',
            'totalEarningsPerFight',
        ));
    }
}
