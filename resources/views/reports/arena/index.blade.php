@extends('commons.layout')
@section('title')
Total Bets
@endsection

@section('page-title')
{{$data['title'] ?? null}}
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('global/vendor/chartist/chartist.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/chartist-plugin-legend/chartist-plugin-legend.css')}}">
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Reports</li>
<li class="breadcrumb-item active">{{$data['title'] ?? null}}</li>
@endsection

@section('page-content')
@include('filters.finance.filter-date')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-6 col-lg-6">
        @include('reports.arena.table')
    </div>
    <div class="col-xxl-6 col-lg-6">
        @include('reports.arena.chart')
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('global/vendor/chartist/chartist.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartist-plugin-legend/0.6.2/chartist-plugin-legend.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartist-plugin-legend/0.6.2/chartist-plugin-legend.js"></script>
<script src="https://htmlstream.com/preview/nova-v1.2/assets/vendor/chartist-bar-labels/src/scripts/chartist-bar-labels.js"></script>
<script src="https://htmlstream.com/preview/nova-v1.2/assets/vendor/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js"></script>
<script src="{{asset('app/js/finance/reports.js')}}"></script>
@endpush