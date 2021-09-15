@extends('commons.layout')
@section('title')
Magnus Earnings
@endsection

@section('page-title')
Magnus Earnings
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Finance Reports</li>
<li class="breadcrumb-item active">Magnus Earnings</li>
@endsection

@section('page-header-actions')
    <a href="{{route('dashboard.finance.total-fights') . '?view=table'}}" class="btn btn-icon btn-primary" title="toggle to dashboard view"><i class="icon wb-dashboard" aria-hidden="true"></i></a>
@endsection

@section('page-content')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-6 col-lg-6">
        <div class="card card-block p-25 bg-blue-600">
          	<div class="counter counter-lg counter-inverse">
            	<div class="counter-label text-uppercase">Today's Earnings</div>
            	<span class="counter-number">{{$earningsToday ?? '₱10,000'}}</span>
          	</div>
        </div>
    </div>      

    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Earnings per DAY (August 2021)</p>
            	<div class="p-5 h-400">
                    <div class="total-earnings-per-day"></div>
	        	</div>
        	</div>
        </div>
    </div>      
</div>

<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Earnings per MONTH</p>
            	<div class="p-5 h-400">
                    <div class="total-earnings-per-month"></div>
	        	</div>
        	</div>
        </div>
    </div>      

    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Earnings per YEAR</p>
            	<div class="p-5 h-400">
                    <div class="total-earnings-per-year"></div>
	        	</div>
        	</div>
        </div>
    </div>      
</div>
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Earnings per ARENA</p>
            	<div class="p-5 h-400">
                    <div class="total-earnings-per-arena"></div>
	        	</div>
        	</div>
        </div>
    </div>      

    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Earnings per FIGHT</p>
            	<div class="p-5 h-400">
                    <div class="total-earnings-per-fight"></div>
	        	</div>
        	</div>
        </div>
    </div>      
</div>
@endsection
