@extends('commons.layout')
@section('title')
Bet History
@endsection

@section('page-title')
Bet History
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">Bet History</li>
@endsection


@section('page-content')
<div class="row">
    <div class="col">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Bet List</h3>
                <div class="panel-actions panel-actions-keep">
                     <a class="panel-action" data-target="#filterBets" data-toggle="modal">
                        <i class="icon wb-more-vertical" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Fight Schedule</th>
                                <th>Fight no</th>
                                <th>Arena</th>
                                <th>Account</th>
                                <th>Pick</th>
                                <th>Odds</th>
                                <th>Bet Amount</th>
                                <th>Prize</th>
                                <th>Result</th>
                                <th>Bet Date</th>
                                <th>Result Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bets as $key => $bet)

                            <tr>
                                <td>{{$bet->fight->schedule ?? ''}}</td>
                                <td>{{$bet->fight->fight_no ?? ''}}</td>
                                <td>{{$bet->fight->arena->name ?? ''}}</td>
                                <td>{{$bet->affiliate->username ?? ''}}</td>
                                <td>{{$bet->pick ?? ''}}</td>
                                <td>{{$bet->odds ?? ''}}</td>
                                <td class="text-right">{{$bet->amount ? moneyFormat($bet->amount): ''}}</td>
                                <td class="text-right">{{$bet->prize ? moneyFormat($bet->prize): ''}}</td>
                                <td>{{$bet->result ?? ''}}</td>
                                <td>{{$bet->bet_date ?? ''}}</td>
                                <td>{{$bet->result_date ?? ''}}</td>
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
                        <p>Showing {{ $bets->firstItem() }} to {{ $bets->lastItem() }}
                        of total {{$bets->total()}} entries</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        {{ $bets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterBets" aria-labelledby="filterBets" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-simple modal-sidebar modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Filter Bets</h4>
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
