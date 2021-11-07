@extends('commons.layout')
@section('title')
Gross Commission Tax Reports
@endsection

@section('page-title')
Gross Commission Tax Reports
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('global/vendor/chartist/chartist.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-legend/chartist-plugin-legend.css')}}">
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Reports</li>
<li class="breadcrumb-item active">Gross Commission Tax Reports</li>
@endsection

@section('page-content')
@include('filters.for-reports')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-12 col-lg-12">
        @include('tax.gross-commission.table')
    </div>
</div>
@endsection
