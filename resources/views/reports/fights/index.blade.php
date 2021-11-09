@extends('commons.layout')
@section('title')
Total Fights
@endsection

@section('page-title')
Total Fights
@endsection
@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Reports</li>
<li class="breadcrumb-item active">Total Fights</li>
@endsection

@section('page-content')
@include('filters.for-reports')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-12 col-lg-12  div-table">
        @include('reports.fights.table')
    </div>
</div>
@endsection
