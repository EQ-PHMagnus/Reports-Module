@extends('commons.layout')
@section('title')
Bettors Transaction History
@endsection

@section('page-title')
Bettors Transaction History
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">Bettors Transaction History</li>
@endsection


@section('page-content')
<div class="row">
    <div class="col">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Bettors Transaction History</h3>
                <div class="panel-actions panel-actions-keep">
                     <a class="panel-action" data-target="#filterHistory" data-toggle="modal">
                        <i class="icon fa-filter font-size-20" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Agent</th>
                                <th>Transaction Type</th>
                                <th class="text-center">Amount</th>
                                <th>Status</th>
                                <th>Date Processed</th>
                                <th>Created at</th>
                                <th>By:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $key => $transaction)
                            <tr>
                                <td>{{$transaction->agent->username ?? ''}}</td>
                                <td>{{strtoupper($transaction->type)}}</td>
                                <td class="text-right">{{$transaction->amount ? moneyFormat($transaction->amount): ''}}</td>
                                <td>{{$transaction->status ?? ''}}</td>
                                <td>{{$transaction->approved_date ?? ''}}</td>
                                <td>{{$transaction->created_at ?? ''}}</td>
                                <td>{{'Approving Officer'}}</td>
                            </tr>
                            @empty
                                <tr><td class="text-center" colspan="5">No records found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row "> 
                    <div class="col-12 d-flex justify-content-center">
                        <p>Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }}
                        of total {{$transactions->total()}} entries</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterHistory" aria-labelledby="filterHistory" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Filter Transactions</h4>
                </div>
                <div class="modal-body">
                    <form method="GET" autocomplete="off">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search" value="{{request('search')}}" autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block">Submit</button>
                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
