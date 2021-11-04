@extends('commons.layout')
@section('title')
Gross Receipts Tax Reports
@endsection

@section('page-title')
Gross Receipts Tax Reports
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('global/vendor/chartist/chartist.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-legend/chartist-plugin-legend.css')}}">
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Reports</li>
<li class="breadcrumb-item active">Gross Receipts Tax Reports</li>
@endsection

@section('page-content')
@include('filters.finance.filter-date')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-12 col-lg-12">
        @include('tax.gross-receipts.table')
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('app/js/finance/reports.js')}}"></script>
@endpush