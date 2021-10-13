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
use App\Http\Controllers\AgentDepositController;
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

Route::group(['prefix' => 'raven'], function() {
    Route::get('/login', function () {
        return view('auth.login')->name('raven.login');
    });
});

Route::prefix('raven')
    ->middleware(['auth'])
    ->group(function(){
    
  
    /*
    |--------------------------------------------------------------------------
    | Auth
    |--------------------------------------------------------------------------
    |
    */
    // Route::redirect('/','raven/masterfile/agents');
    Route::redirect('/', 'raven/bets/total-count-bets')->name('reports');
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('raven.logout');  
    


    /*
    |--------------------------------------------------------------------------
    | FINANCE
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/total-fights', [FinanceController::class, 'totalFights'])->name('dashboard.finance.total-fights');
    Route::get('/magnus-earnings', [FinanceController::class, 'magnusEarnings'])->name('dashboard.finance.magnus-earnings');
    Route::get('/super-agent-accounts', [FinanceController::class, 'superAgentAccounts'])->name('dashboard.finance.agent-accounts');
    Route::get('/tax-computations', [FinanceController::class, 'getTaxComputations'])->name('dashboard.finance.tax-computations');

    /*
    |--------------------------------------------------------------------------
    | Transactions
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('transactions', TransactionController::class);
    Route::group(['prefix' => 'transactions-history'], function() {
        Route::get('agent-transactions', [TransactionHistoryController::class, 'getAgentTransactions'])->name('dashboard.transactions.agent-transactions');
        Route::get('bettor-transactions', [TransactionHistoryController::class, 'getBettorsTransactions'])->name('dashboard.transactions.bettors-transactions');
    });


    /*
    |--------------------------------------------------------------------------
    | Players
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('players', PlayerController::class);
    

    /*
    |--------------------------------------------------------------------------
    | Agents
    |--------------------------------------------------------------------------
    |
    */
    Route::get('search-agent', [AgentController::class,'searchAgent'])->name('search-agent');
    Route::resource('agents', AgentController::class);


    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/fights/{type}', [ReportsController::class, 'fights'])->name('reports.bets.fights');
    Route::get('/bets/{type}', [ReportsController::class, 'bets'])->name('reports.bets.bets');
   
    
    /*
    |--------------------------------------------------------------------------
    | MAIN
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('fights', FightController::class);
    Route::resource('bets', BetController::class);
    Route::resource('arenas', ArenaController::class);


    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => 'users'], function() {
        Route::resource('users', UserController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Agent Deposits
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => 'agent-deposits'], function() {
        Route::resource('agent-deposits', AgentDepositController::class)->names([
            'destroy' => 'agent-deposits.destroy',
            'update'  => 'agent-deposits.update',
        ]);
    });

   
});

require __DIR__.'/auth.php';

