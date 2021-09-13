<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function totalBets(){
        return view('dashboard.finance.total-bets');
    }

    public function totalFights()
    {
        return view('dashboard.finance.total-fights');
    }

    public function magnusEarnings()
    {
        return view('dashboard.finance.magnus-earnings');
    }
}
