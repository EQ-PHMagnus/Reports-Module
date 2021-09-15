@extends('commons.layout')
@section('title')
Total Fights
@endsection

@section('page-title')
Total Fights
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Finance Reports</li>
<li class="breadcrumb-item active">Total Fights</li>
@endsection

@section('page-header-actions')
    <a href="{{route('dashboard.finance.total-fights')}}" class="btn btn-icon btn-primary btn-outline"><i class="icon wb-dashboard" aria-hidden="true"></i></a>
@endsection

@section('page-content')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Fights per YEAR</p>
            	<div class="p-5 h-300">
                    <div class="total-fights-year"></div>
	        	</div>
        	</div>
        </div>
    </div>      

    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Fights per MONTH</p>
            	<div class="p-5 h-300">
                    <div class="total-fights-month"></div>
	        	</div>
        	</div>
        </div>
    </div>      
</div>

<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Fights per DAY (August 2021)</p>
            	<div class="p-5 h-300">
                    <div class="total-fights-day"></div>
	        	</div>
        	</div>
        </div>
    </div>      

    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Number of Fights per arena</p>
            	<div class="p-5 h-300">
                    <div class="total-fights-arena"></div>
	        	</div>
        	</div>
        </div>
    </div>      
</div>
@endsection

@push('scripts')
<script>
    let totalFightsPerYearData= {!! json_encode($totalFightsPerYear) !!};
    let totalNumberFightsPerMonth = {!! json_encode($totalNumberFightsPerMonth) !!};
    let totalNumberFightsPerDay = {!! json_encode($totalNumberFightsPerDay) !!};
    let totalNumberFightsPerArena = {!! json_encode($totalNumberFightsPerArena) !!};

    let barGraphData = {
        labels: [],
        series: []
    };
    let series = [];
    
    for (var key in totalFightsPerYearData) {
        if (totalFightsPerYearData.hasOwnProperty(key)) {
            barGraphData.labels.push(key);
            series.push(totalFightsPerYearData[key]);
        }
    }
    
    barGraphData.series.push(series);

    let barGraphOptions = {
        axisY: {
            onlyInteger : true
        },
        height: '300px',
    };

    let lineGraphOptions = {
        axisY: {
            onlyInteger : true
        },
        low: 0,
        showArea: true,
        height: '300px'
    };

    new Chartist.Bar('.total-fights-year',barGraphData,barGraphOptions);

    new Chartist.Line('.total-fights-month',totalNumberFightsPerMonth, lineGraphOptions);

    new Chartist.Bar('.total-fights-day',totalNumberFightsPerDay, barGraphOptions);

    new Chartist.Bar('.total-fights-arena', totalNumberFightsPerArena , barGraphOptions);
</script>
@endpush