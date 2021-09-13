<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\FinanceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/','dashboard/total-bets');
Route::namespace('Dashboard')
    ->prefix('dashboard')
    ->group(function(){
    Route::get('/total-bets', [FinanceController::class, 'totalBets'])->name('dashboard.finance.total-bets');
    Route::get('/total-fights', [FinanceController::class, 'totalFights'])->name('dashboard.finance.total-fights');
    Route::get('/magnus-earnings', [FinanceController::class, 'magnusEarnings'])->name('dashboard.finance.magnus-earnings');
});

