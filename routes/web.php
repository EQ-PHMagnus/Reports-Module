<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\FinanceController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\MasterAgentDepositController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\FightController;
use App\Http\Controllers\BetController;
use App\Http\Controllers\ArenaController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AgentDepositController;
use App\Http\Controllers\RolesAndPermissionController;
use App\Http\Controllers\PermissionsAndRoutesController;
use App\Http\Controllers\ImportDataController;
use App\Http\Controllers\AgentCommissionController;
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
// Route::view('login', 'auth.login')->name('login');


Route::middleware(['auth'])
    ->group(function(){
    /*
    |--------------------------------------------------------------------------
    | Auth
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/', [AuthenticatedSessionController::class, 'handleRedirectToHome']);

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



    /*
    |--------------------------------------------------------------------------
    | FINANCE
    |--------------------------------------------------------------------------
    |
    */
    // Route::get('/total-fights', [FinanceController::class, 'totalFights'])->name('dashboard.finance.total-fights');
    // Route::get('/magnus-earnings', [FinanceController::class, 'magnusEarnings'])->name('dashboard.finance.magnus-earnings');
    // Route::get('/super-agent-accounts', [FinanceController::class, 'superAgentAccounts'])->name('dashboard.finance.agent-accounts');
    // Route::get('/tax-computations', [FinanceController::class, 'getTaxComputations'])->name('dashboard.finance.tax-computations');
    Route::get('/gross-receipts', [TaxController::class, 'grossReceipts'])->name('tax.gross-receipts');
    Route::get('/total-GBR', [TaxController::class, 'totalGBR'])->name('tax.total-GBR');
    Route::get('/gross-commission', [TaxController::class, 'grossCommission'])->name('tax.gross-commission');
    Route::get('/net-commission', [TaxController::class, 'netCommission'])->name('tax.net-commission');
    Route::get('/final-taxes-winnings', [TaxController::class, 'finalTaxesWinnings'])->name('tax.final-taxes-winnings');

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
    // Route::resource('players', PlayerController::class);
    Route::group(['prefix' => 'players'], function() {
        Route::get('/players_earnings', [PlayerController::class, 'earnings'])->name('players.earnings');
        Route::get('/players_cash_in', [PlayerController::class, 'cash_in'])->name('players.cash_in');
        Route::get('/players_cash_out', [PlayerController::class, 'cash_out'])->name('players.cash_out');
    });



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
    Route::get('total-fights', [ReportsController::class, 'totalFights'])->name('reports.total-fights');
    Route::get('total-bets', [ReportsController::class, 'totalBets'])->name('reports.total-bets');


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
    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | Agent Deposits
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('agent-deposits', AgentDepositController::class)->names([
        'index' => 'agent-deposits.index'
    ]);


    /*
    |--------------------------------------------------------------------------
    | Master Agent Deposits
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('master-agent-deposits', MasterAgentDepositController::class)->names([
        'index' => 'master-agent-deposits.index'
    ]);

      
     /*
    |--------------------------------------------------------------------------
    | Agent Commissions
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => 'agent-commissions'], function() {
        Route::get('/super_agent', [AgentCommissionController::class, 'super_agent'])->name('agent-commissions.super_agent');
        Route::get('/agent', [AgentCommissionController::class, 'agent'])->name('agent-commissions.agent');
    });

    /*
    |--------------------------------------------------------------------------
    | Roles And Permissions
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('roles-and-permissions', RolesAndPermissionController::class);
    Route::resource('permissions-and-actions',PermissionsAndRoutesController::class);
    Route::get('roles-and-permissions/get-permission-names',[RolesAndPermissionController::class, 'getPermissionsViaRoles']);
    Route::post('roles-and-permissions/assign-permissions',[RolesAndPermissionController::class, 'assignPermissions'])->name('roles-and-permissions.assign-permissions');
    Route::post('permissions-and-actions/assign-permissions',[PermissionsAndRoutesController::class,'assignPermissions'])->name('permissions-and-actions.assign-permissions');

    /*
    |--------------------------------------------------------------------------
    | Import Data
    |--------------------------------------------------------------------------
    |
    */
    Route::resource('import-data', ImportDataController::class);

});

require __DIR__.'/auth.php';

