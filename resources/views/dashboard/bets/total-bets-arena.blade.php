@extends('commons.layout')
@section('title')
Total Bets
@endsection

@section('page-title')
Total Bets
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Finance Reports</li>
<li class="breadcrumb-item active">Total Bets Arena</li>
@endsection

@section('page-header-actions')
	<a href="{{route('dashboard.finance.total-bets-arena')}}" class="btn btn-icon btn-primary" title="toggle to table view"><i class="icon wb-table" aria-hidden="true"></i></a>
@endsection

@section('page-content')
@include('filters.finance.filter-date')
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

@push('css')
<link rel="stylesheet" href="{{asset('global/vendor/chartist/chartist.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-legend/chartist-plugin-legend.css')}}">
@endpush
@push('scripts')
<script src="{{asset('global/vendor/chartist/chartist.min.js')}}"></script>
<script src="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('global/vendor/chartist-plugin-legend/chartist-plugin-legend.js')}}"></script>
<script src="{{asset('app/js/finance/bets.js')}}"></script>
@endpush