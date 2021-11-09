@extends('commons.layout')
@section('title')
Total Bets
@endsection

@section('page-title')
Total Bets
@endsection
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Reports</li>
<li class="breadcrumb-item active">Total Bets</li>
@endsection

@section('page-content')
@include('filters.for-reports')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-12 col-lg-12">
        @include('reports.bets.table')
    </div>
</div>
@endsection
