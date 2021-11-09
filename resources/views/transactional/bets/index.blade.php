@extends('commons.layout')
@section('title')
Bets
@endsection

@section('page-title')
Bets
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">{{$data['content_title'] ?? null}}</li>
@endsection



@section('page-content')
<div class="row">
    <div class="col">
        <!-- type -->
        <input class="filters" type="hidden" name="type" value="{{$data['type'] ?? ''}}">

        @include('filters.for-list')
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Bets</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table  class="table-fit no-view "
                        data-mobile-responsive="true"
                        data-toggle="table"
                        data-ajax="dataRequest"
                        data-search="true"
                        data-side-pagination="server"
                        data-sortable="true"
                        data-detail-formatter="detailFormatter"
                        data-pagination="true"
                        data-sort-order="desc">
                        <thead>
                            <tr>
                                <th data-field="fight_schedule" data-sortable="true">Fight Schedule</th>
                                <th data-field="fight_no">Fight no</th>
                                <th data-field="arena">Arena</th>
                                <th data-field="affiliate_name">Account</th>
                                <th data-field="pick">Pick</th>
                                <th data-field="fight_schedule">Odds</th>
                                <th data-field="odds" class="text-center">Bet Amount</th>
                                <th data-field="prize" class="text-center">Prize</th>
                                <th data-field="result">Result</th>
                                <th data-field="bet_date" data-sortable="true">Bet Date</th>
                                <th data-field="result_date" data-sortable="true">Result Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
