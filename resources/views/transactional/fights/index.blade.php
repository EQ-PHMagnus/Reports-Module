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
                                <th data-field="fight_no">Fight no</th>
                                <th data-field="arena">Arena</th>
                                <th data-field="meron" class="bg-blue-600 text-white">Meron</th>
                                <th data-field="meron_lb" class="bg-blue-600 text-white">LB</th>
                                <th data-field="meron_wb" class="bg-blue-600 text-white">WB</th>
                                <th data-field="meron_wt" class="bg-blue-600 text-white">WT</th>
                                <th data-field="wala" class="bg-red-600 text-white">WALA</th>
                                <th data-field="wala_lb" class="bg-red-600 text-white">LB</th>
                                <th data-field="wala_wb" class="bg-red-600 text-white">WB</th>
                                <th data-field="wala_wt" class="bg-red-600 text-white">WT</th>
                                <th data-field="schedule" class="text-center" data-sortable="true">Schedule</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection