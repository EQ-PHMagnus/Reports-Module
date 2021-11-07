@extends('commons.layout')
@section('title')
Total Bets
@endsection

@section('page-title')
Total Bets Arena
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('global/vendor/chartist/chartist.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-legend/chartist-plugin-legend.css')}}">
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Finance Reports</li>
<li class="breadcrumb-item active">Total Bets Arena</li>
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
    <div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<h4 class="text-center">Total Number of Bets per Arena</h4>
            	<div class="p-5 h-400">
            		<div class="number-bets"></div>
	        	</div>
        	</div>
        </div>
    </div>          
    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<h4 class="text-center">Total Amount of Bets per Arena</h4>
            	<div class="p-5 h-400">
            		<div class="amount-bets"></div>
	        	</div>
        	</div>
        </div>
    </div>          
</div>
@endsection
@push('scripts')
<script src="{{asset('global/vendor/chartist/chartist.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartist-plugin-legend/0.6.2/chartist-plugin-legend.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartist-plugin-legend/0.6.2/chartist-plugin-legend.js"></script>
<script src="https://htmlstream.com/preview/nova-v1.2/assets/vendor/chartist-bar-labels/src/scripts/chartist-bar-labels.js"></script>
<script src="https://htmlstream.com/preview/nova-v1.2/assets/vendor/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js"></script>
<script src="{{asset('app/js/finance/bets.js')}}"></script>
@endpush
