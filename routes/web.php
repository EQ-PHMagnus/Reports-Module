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
Route::view('raven/login', 'auth.login')->name('raven.login');


Route::prefix('raven')
    ->middleware(['auth'])
    ->group(function(){
    /*
    |--------------------------------------------------------------------------
    | Auth
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/', [AuthenticatedSessionController::class, 'handleRedirectToHome']);

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
    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | Agent Deposits
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => 'agent-deposits'], function() {
        Route::get('/pending', [AgentDepositController::class, 'pending'])->name('agent-deposits.pending');
        Route::put('/pending/{id}', [AgentDepositController::class, 'update'])->name('agent-deposits.update');
        Route::get('/processed', [AgentDepositController::class, 'processed'])->name('agent-deposits.processed');
    });

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

