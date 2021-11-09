@extends('commons.layout')
@section('title')
{{$data['title'] ?? null}}
@endsection

@section('page-title')
{{$data['title'] ?? null}}
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
                <h3 class="panel-title">{{$data['content_title'] ?? null}}</h3>
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
                                <th class="text-left" data-field="player_name" >Player Name</th>
                                <th class="text-left" data-field="current_credits"  class="text-center">Credits</th>
                                <th class="text-left" data-field="phone_no" >Phone Number</th>
                                <th class="text-left" data-field="status">Status</th>
                                <th class="text-left" data-field="transaction_date" data-sortable="true">Transaction Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
