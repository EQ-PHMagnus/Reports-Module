<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bet;
use App\Models\PrototypeData;
use App\Http\Traits\Chartist;
use App\Http\Traits\Bets;

class FinanceController extends Controller
{
    use Chartist, Bets;

    public $model;
    public function __construct(){
        $this->model = new Bet;
    }

    public function totalBets(Request $request){
        // CHARTS
        $chartView  = request()->input('view',null) == 'dashboard';
        if($chartView == true){
            return view('dashboard.bets.total-bets');
        }
        // DATA TABLE
        if(request()->ajax()) {
            $result = $this->getTotalBets($request);
            return response()->json($result);
        }
        return view('tables.bets.total-bets');
    }

    public function totalBetsArena(Request $request){
        // CHARTS
        $chartView  = request()->input('view',null) == 'dashboard';
        if($chartView == true){
            return view('dashboard.bets.total-bets-arena');
        }
        // DATA TABLE
        if(request()->ajax()) {
            $result = $this->getTotalBetsArena($request);
            return response()->json($result);
        }
        return view('tables.bets.total-bets-arena');
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

    public function getTaxComputations(){
        $tb = Bet::sum('amount');
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
        
        return view('tables.finance.tax-computations',compact(
            'grb',
            'grb_breakdown',
            'on_gc',
            'on_nc',
        ));
    }    
}
