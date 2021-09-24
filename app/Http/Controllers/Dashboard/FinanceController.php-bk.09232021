<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrototypeData;
use App\Http\Traits\Chartist;

class FinanceController extends Controller
{
    use Chartist;

    public $model;
    public function __construct(){
        $this->model = new PrototypeData;
    }

    public function totalBets(){
        $view = 'tables.finance.total-bets';
        $dashboardView = request()->input('view',null) == 'dashboard';
        
        $bets = $this->model->getBetsData();

        $totalBetsPerYear = $bets->groupBy('year')->map->count();
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

        $totalNumberBetsPerArena = $bets->groupBy('arena')->map->count();

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
        
        return view($view,compact(
            'bets',
            'totalAmountBetsPerYear',
            'totalAmountBetsPerArena',
            'yearAndTotalAmountBetsPerMonth',
            'yearAndTotalAmountBetsPerDay',
            'totalNumberBetsPerMonth',
            'totalBetsPerYear',
            'totalNumberBetsPerDay',
            'totalNumberBetsPerArena'
        ));
    }

    public function totalFights()
    {
        $view = 'tables.finance.total-fights';
        $dashboardView = request()->input('view',null) == 'dashboard';
        
        $fights = $this->model->getFightsData();

        $totalFightsPerYear = $fights->groupBy('year')->map->count();
        $totalNumberFightsPerDay = $fights->where('month','August')->groupBy('month_and_day')->map->count();
        $totalNumberFightsPerArena = $fights->groupBy('arena')->map->count();

        $totalNumberFightsPerMonth = $fights->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month')->map(function($permonth){
                return $permonth->count();
             });
        });

        if($dashboardView == true){
            $totalFightsPerYear = $this->formatBar($totalFightsPerYear);
            $totalNumberFightsPerDay = $this->formatBar($totalNumberFightsPerDay);
            $totalNumberFightsPerArena = $this->formatBar($totalNumberFightsPerArena);

            $totalNumberFightsPerMonth = $this->formatLine($totalNumberFightsPerMonth);
            
            $view = 'dashboard.finance.total-fights';
        }

        return view($view,compact(
            'fights',
            'totalFightsPerYear',
            'totalNumberFightsPerMonth',
            'totalNumberFightsPerDay',
            'totalNumberFightsPerArena'
        ));
    }

    public function magnusEarnings()
    {
        $view = 'tables.finance.magnus-earnings';
        $dashboardView = request()->input('view',null) == 'dashboard';

        $fights = $this->model->getMagnusEarningsData();
        $totalEarningsPerArena = $fights->groupBy('arena')->map->sum('magnus_earnings');
        $totalEarningsPerFight = $fights->groupBy('fight_no')->map->sum('magnus_earnings');
        
        $totalEarningsPerDay = $fights->where('month','August')
        // ->where('year','2021')
        ->groupBy('day')->map(function($data,$day){
             return $data->sum('magnus_earnings');
        });
        
        $totalEarningsPerYear = $fights->groupBy('year')->map(function($data,$year){
             return $data->groupBy('month')->map(function($permonth){
                return $permonth->sum('magnus_earnings');
             });
        });

        $totalEarningsPerMonthFormat = [
            'labels' => [],
            'series' => []
        ];
        
        $totalEarningsPerMonth = $fights->groupBy('year')
            ->map(function($perYear,$year){
                return $perYear->groupBy('month')->map(function($permonth) use ($year){
                   return $permonth->sum('magnus_earnings');
            });
        });       

        $subSeries = [];
         foreach($totalEarningsPerMonth as $year => $perYearData ){
            foreach($perYearData as $month => $perMonthData){   
            $monthYear = $month . ' ' . $year;
            if(!in_array($monthYear, $totalEarningsPerMonthFormat['labels']))
                $totalEarningsPerMonthFormat['labels'][] = $monthYear;
                $subSeries[] = $perMonthData;
            }
        }
        $totalEarningsPerMonthFormat['series'][] = $subSeries;   


        if($dashboardView == true){
            $totalEarningsPerDay = $this->formatBar($totalEarningsPerDay,'August');
            $totalEarningsPerArena = $this->formatBar($totalEarningsPerArena);
            $totalEarningsPerFight = $this->formatBar($totalEarningsPerFight);

            $totalEarningsPerMonth = $totalEarningsPerMonthFormat;
            $totalEarningsPerYear = $this->formatLine($totalEarningsPerYear);
            // $totalEarningsPerYear = $this->formatLine($totalEarningsPerYear);
            
            $view = 'dashboard.finance.magnus-earnings';
        }

        return view('tables.finance.magnus-earnings',compact(
            'fights',
            'totalEarningsPerDay',
            'totalEarningsPerMonth',
            'totalEarningsPerYear',
            'totalEarningsPerArena',
            'totalEarningsPerFight',
        ));
    }

    public function superAgentAccounts(){
        return view('tables.finance.super-agent-accounts');
    }
}
