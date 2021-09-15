@extends('commons.layout')
@section('title')
Total Bets
@endsection

@section('page-title')
Total Bets
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Finance Reports</li>
<li class="breadcrumb-item active">Total Bets</li>
@endsection

@section('page-header-actions')
	<a href="{{route('dashboard.finance.total-bets') . '?view=table'}}" class="btn btn-icon btn-primary"><i class="icon wb-grid-9" aria-hidden="true"></i></a>
@endsection

@section('page-content')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Number of Bets per YEAR</p>
            	<div class="p-5 h-300">
            		<div class="number-bets-year"></div>
	        	</div>
        	</div>
        </div>
    </div>      

    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Number of Bets per MONTH</p>
        		<div class="p-5 h-300">
            		<div class="total-bets-month"></div>
	        	</div>
        	</div>
        </div>
    </div>      

    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Number of Bets per DAY</p>
        		<div class="p-5 h-300">
            		<div class="total-bets-day"></div>
	        	</div>
        	</div>
        </div>
    </div>      
</div>

<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
        	<div class="card-body">
        		<p>Total Amount of Bets per YEAR</p>
            	<div class="p-5 h-300">
            		<div class="amount-bets-year"></div>
	        	</div>
        	</div>
        </div>
    </div>      

    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
          	<div class="card-body">
            	<p>Year and Total Number of Bets per MONTH</p>
            	<div class="p-5 h-300">
            		<div class="years-and-amount-bets-month"></div>
	        	</div>
        	</div>
        </div>
    </div>      

    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>2020 and 2021</p>
        		<div class="p-5 h-300">
            		<div class="years-and-amount-bets-day"></div>
	        	</div>
        	</div>
        </div>
    </div>      
</div>

<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Number of Bets per arena</p>
        		<div class="p-5 h-400">
            		<div class="total-bets-arena text-center"></div>
	        	</div>
        	</div>
        </div>
    </div>      

    <div class="col-xxl-6 col-lg-6">
        <div class="card card-shadow" >
          	<div class="card-body">
        		<p>Total Amount of Bets per arena</p>
            	<div class="p-5 h-300">
            		<div class="amount-bets-arena"></div>
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

	let totalAmountBetsPerYear= {!! json_encode($totalAmountBetsPerYear) !!};
	let totalAmountBetsPerArena= {!! json_encode($totalAmountBetsPerArena) !!};
	let yearAndTotalAmountBetsPerMonth= {!! json_encode($yearAndTotalAmountBetsPerMonth) !!};
	let yearAndTotalAmountBetsPerDay= {!! json_encode($yearAndTotalAmountBetsPerDay) !!};
	let totalBetsPerYearData= {!! json_encode($totalBetsPerYear) !!};
	let totalNumberBetsPerMonth = {!! json_encode($totalNumberBetsPerMonth) !!};
	let totalNumberBetsPerDay = {!! json_encode($totalNumberBetsPerDay) !!};
	let totalNumberBetsPerArena = {!! json_encode($totalNumberBetsPerArena) !!};

	let barGraphData = {
		labels: [],
		series: []
	};
	let series = [];
	
	for (var key in totalBetsPerYearData) {
		if (totalBetsPerYearData.hasOwnProperty(key)) {
        	barGraphData.labels.push(key);
        	series.push(totalBetsPerYearData[key]);
    	}
	}
	
	barGraphData.series.push(series);

	let barGraphOptions = {
		axisY: {
			onlyInteger : true
		},
		height: '300px',
	};

	new Chartist.Bar('.number-bets-year',barGraphData,barGraphOptions);

	barGraphData = {
		labels: [],
		series: []
	};
	series = [];

	for (var key in totalAmountBetsPerYear) {
		if (totalAmountBetsPerYear.hasOwnProperty(key)) {
        	barGraphData.labels.push(key);
        	series.push(totalAmountBetsPerYear[key]);
    	}
	}

	barGraphData.series.push(series);

	barGraphOptions = {
		axisY: {
			labelInterpolationFnc: function(value,idx) {
				return formatter.format(value);  	
			}
		},
		height: '300px',
		chartPadding: {
		    left: 40
		 },
	};
	new Chartist.Bar('.amount-bets-year',barGraphData,barGraphOptions);

	barGraphData = {
		labels: [],
		series: []
	};
	series = [];

	for (var key in totalAmountBetsPerArena) {
		if (totalAmountBetsPerArena.hasOwnProperty(key)) {
        	barGraphData.labels.push(key);
        	series.push(totalAmountBetsPerArena[key]);
    	}
	}

	barGraphData.series.push(series);

	barGraphOptions = {
		axisY: {
			labelInterpolationFnc: function(value,idx) {
				return formatter.format(value);  	
			}
		},
		height: '300px',
		chartPadding: {
		    left: 40
		 },
	};
	new Chartist.Bar('.amount-bets-arena',barGraphData,barGraphOptions);


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

	new Chartist.Line('.years-and-amount-bets-month',yearAndTotalAmountBetsPerMonth, lineGraphOptions);

	new Chartist.Line('.years-and-amount-bets-day',yearAndTotalAmountBetsPerDay, lineGraphOptions);

	lineGraphOptions.axisY = {
		labelInterpolationFnc: Chartist.noop,
		onlyInteger : true
	};
	lineGraphOptions.chartPadding = {
		left: 0
	};

	new Chartist.Line('.total-bets-month',totalNumberBetsPerMonth, lineGraphOptions);

	new Chartist.Line('.total-bets-day',totalNumberBetsPerDay, lineGraphOptions);

	const pieChartLabels = totalNumberBetsPerArena.labels;

	const  sum = function(a, b) { return a + b };
	
	const  options = {
	  labelInterpolationFnc: function(value,idx) {
	  	const percentage = Math.round(value / totalNumberBetsPerArena.series.reduce(sum) * 100) + '%'
	    return pieChartLabels[idx] + ' ' + percentage;
	  },
  		height: '400px',
  		labelPosition: 'outside',
  		labelOffset: 40,
  		chartPadding: 40,
	};

	var responsiveOptions = [
	  ['screen and (min-width: 640px)', {
	    chartPadding: 30,
	    labelOffset: 100,
	    labelDirection: 'explode',
	    labelInterpolationFnc: function(value) {
	      return value;
	    }
	  }],
	  ['screen and (min-width: 1024px)', {
	    labelOffset: 80,
	    chartPadding: 20
	  }]
	];

	let pieChartData = {
		series : totalNumberBetsPerArena.series
	}
	
	new Chartist.Pie('.total-bets-arena', pieChartData , options);
</script>
@endpush