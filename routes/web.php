<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\FightController;
use App\Http\Controllers\BetController;
use App\Http\Controllers\ArenaController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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


Route::view('/','landing');
Route::prefix('raven')
    ->group(function(){
    
    Route::redirect('/','raven/masterfile/agents');
    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/', function () {
        return redirect('login');
    });

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);  
    Route::get('/total-fights', [FinanceController::class, 'totalFights'])->name('dashboard.finance.total-fights');
    Route::get('/magnus-earnings', [FinanceController::class, 'magnusEarnings'])->name('dashboard.finance.magnus-earnings');
    Route::get('/super-agent-accounts', [FinanceController::class, 'superAgentAccounts'])->name('dashboard.finance.agent-accounts');
    Route::get('/tax-computations', [FinanceController::class, 'getTaxComputations'])->name('dashboard.finance.tax-computations');



    Route::group(['prefix' => 'transactions-history'], function() {
        Route::get('agent-transactions', [TransactionHistoryController::class, 'getAgentTransactions'])->name('dashboard.transactions.agent-transactions');
        Route::get('bettor-transactions', [TransactionHistoryController::class, 'getBettorsTransactions'])->name('dashboard.transactions.bettors-transactions');
    });

    Route::resource('players', PlayerController::class);
    
    Route::get('search-agent', [AgentController::class,'searchAgent'])->name('search-agent');
    Route::resource('agents', AgentController::class);

    Route::get('/fights/{type}', [ReportsController::class, 'fights'])->name('reports.bets.fights');
    Route::resource('fights', FightController::class);

    Route::get('/bets/{type}', [ReportsController::class, 'bets'])->name('reports.bets.bets');
    Route::resource('bets', BetController::class);
    
    Route::resource('arenas', ArenaController::class);
    Route::resource('transactions', TransactionController::class);

     /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['prefix' => 'users'], function() {
        Route::resource('users', UserController::class)->middleware(['auth']);
    });



    Route::get('/', function () {
        return redirect('raven/bets/total-count-bets');
    })->middleware(['auth'])->name('reports');

});

require __DIR__.'/auth.php';

