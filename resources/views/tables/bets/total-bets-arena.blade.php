@extends('commons.layout')
@section('title')
Total Bets
@endsection

@section('page-title')
Total Bets Arena
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Finance Reports</li>
<li class="breadcrumb-item active">Total Bets Arena</li>
@endsection

@section('page-header-actions')
	<a href="{{route('dashboard.finance.total-bets-arena') . '?view=dashboard'}}" class="btn btn-icon btn-primary" title="toggle to dashboard view"><i class="icon wb-dashboard" aria-hidden="true"></i></a>
@endsection

@section('page-content')
    @include('filters.finance.filter-date')
    <div class="row" data-plugin="matchHeight" data-by-row="true">
        <div class="col-xxl-6 col-lg-6">
            <div class="card card-shadow" >
                <div class="card-header text-center bg-primary">
                    Total Number of Bets per Arena
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table-fit no-view "
                            data-mobile-responsive="true"
                            data-toggle="table"
                            data-ajax="dataRequest"
                            data-side-pagination="server"
                            data-sortable="true"
                            data-detail-formatter="detailFormatter"
                            data-pagination="true"
                            data-sort-order="desc">
                            <thead>
                                <tr>
                                    <th  class="text-left" data-field="arena">Arena </th>
                                    <th  class="text-left" data-field="date">Date </th>
                                    <th  class="text-left" data-field="count">Count</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-xxl-6 col-lg-6">
            <div class="card card-shadow" >
                <div class="card-header text-center bg-primary">
                    Total Amount of Bets per Arena
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table-fit no-view "
                            data-mobile-responsive="true"
                            data-toggle="table"
                            data-ajax="dataRequest"
                            data-side-pagination="server"
                            data-sortable="true"
                            data-detail-formatter="detailFormatter"
                            data-pagination="true"
                            data-sort-order="desc"
                            data-chart="false"
                            data-count="false">
                            <thead>
                                <tr>
                                    <th  class="text-left" data-field="arena">Arena </th>
                                    <th  class="text-left" data-field="date">Date </th>
                                    <th  class="text-left" data-field="sum">AMOUNT</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{asset('app/js/finance/bets.js')}}"></script>
@endpush
