@extends('commons.layout')
@section('title')
{{$data['title'] ?? null}}
@endsection

@section('page-title')
{{$data['title'] ?? null}}
@endsection
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Reports</li>
<li class="breadcrumb-item active">{{$data['title'] ?? null}}</li>
@endsection

@section('page-content')
@include('filters.for-reports')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-12 col-lg-12">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
                {{$data['title'] ?? null}}
            </div>
        <div class="card-body">
        <table  class="table-fit no-view "
                        data-mobile-responsive="true"
                        data-toggle="table"
                        data-ajax="dataRequest"
                        data-side-pagination="server"
                        data-sortable="true"
                        data-detail-formatter="detailFormatter"
                        data-pagination="true"
                        data-sort-order="desc"
                        >
                        <thead>
                            <tr>
                                <!-- <th  class="text-left" data-field="name">Name </th>
                                <th  class="text-left" data-field="commission">Commission</th>
                                <th  class="text-left" data-field="amount">Amount</th>
                                <th  class="text-left" data-field="commission_date">Commission Date</th>
                                <th  class="text-left" data-field="level">Level</th> -->
                                <th  class="text-left" data-field="date">Date </th>
                                <th  class="text-left" data-field="count">Count</th>
                                <th  class="text-left" data-field="commission">Total Commission</th>
                                <th  class="text-left" data-field="sum">Amount</th>
                            </tr>
                        </thead>
                    </table>
        </div>
    </div>
</div>
@endsection
