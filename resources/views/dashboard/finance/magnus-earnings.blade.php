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
    <a href="{{route('dashboard.finance.magnus-earnings') . '?view=table'}}" class="btn btn-icon btn-primary" title="toggle to table view"><i class="icon wb-table" aria-hidden="true"></i></a>
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
@push('scripts')
<script type="text/javascript">
	const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'PHP',
        });

    let totalEarningsPerDay= {!! json_encode($totalEarningsPerDay) !!};
    let totalEarningsPerMonth= {!! json_encode($totalEarningsPerMonth) !!};
    let totalEarningsPerYear= {!! json_encode($totalEarningsPerYear) !!};
    let totalEarningsPerArena= {!! json_encode($totalEarningsPerArena) !!};
    let totalEarningsPerFight= {!! json_encode($totalEarningsPerFight) !!};

    let barGraphOptions = {
        axisY: {
            onlyInteger : true
        },
        height: '300px',
        axisY: {
            labelInterpolationFnc: function(value,idx) {
                return formatter.format(value);     
            }
        },
        chartPadding: {
            left: 30
        }
    };

    let lineGraphOptions = {
        low: 0,
        showArea: true,
        height: '300px',
        axisY: {
            labelInterpolationFnc: function(value,idx) {
                return formatter.format(value);     
            }
        },
        chartPadding: {
            left: 30
        }
    };

    new Chartist.Line('.total-earnings-per-day',totalEarningsPerDay, lineGraphOptions);
    new Chartist.Line('.total-earnings-per-month',totalEarningsPerMonth, lineGraphOptions);
    new Chartist.Line('.total-earnings-per-year',totalEarningsPerYear, lineGraphOptions);
    new Chartist.Bar('.total-earnings-per-arena',totalEarningsPerArena, barGraphOptions);
    new Chartist.Bar('.total-earnings-per-fight',totalEarningsPerFight, barGraphOptions);
</script>
@endpush