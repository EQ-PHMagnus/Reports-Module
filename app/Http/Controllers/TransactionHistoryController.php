<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAgentTransactions()
    {
        $transactions = Transaction::with(['bet','agent'])
            ->processed()
            ->cashInCashOut()
            ->orderByDesc('approved_date')
            ->paginate(10)
            ->withQueryString();
        // dd($transactions);
        return view('transaction-history.agents',compact('transactions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBettorsTransactions()
    {
        $transactions = Transaction::with(['bet','agent'])
            ->processed()
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();
        // dd($transactions);
        return view('transaction-history.bettors',compact('transactions'));
    }

   
}
