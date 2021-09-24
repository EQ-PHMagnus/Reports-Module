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
	<a href="{{route('dashboard.finance.total-bets') . '?view=dashboard'}}" class="btn btn-icon btn-primary" title="toggle to dashboard view"><i class="icon wb-dashboard" aria-hidden="true"></i></a>
@endsection

@section('page-content')

	<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-3 col-lg-3">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Number of Bets per YEAR
            </div>
          	<div class="card-body">
            	<div class="table-responsive">
                   
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>COUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($totalBetsPerYear as $key => $val)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{number_format($val)}}</td>
                            </tr>
                        @endforeach
                       
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">{{number_format($totalBetsPerYear->sum())}}</td>
                            </tr>
                       
                        </tbody>
                    </table>
                </div>
        	</div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Number of Bets per MONTH
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th rowspan="{{count($totalNumberBetsPerMonth)}}">Month</th>
                                <th @if(count($totalNumberBetsPerMonth) != 1) class="text-center" @endif colspan="{{count($totalNumberBetsPerMonth)}}">Year</th>
                            </tr>
                            <tr>
                            @foreach($totalNumberBetsPerMonth as $key => $val)
                                @if(count($totalNumberBetsPerMonth) == 1)
                                    <th></th>
                                @endif
                                <th>{{$key}}</th>
                            @endforeach
                            </tr>
                            <tr>
                                @foreach(config('defaults.months') as $month => $monthVals)
                                    <tr>
                                        <td>{{$month}}</td>
                                        @foreach($totalNumberBetsPerMonth as $key => $val)
                                                @if(isset($val[$month]))
                                                    <td>{{$val[$month]}}</td>  
                                                @else
                                                    <td>0</td>
                                                @endif
                                        
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                @foreach($totalNumberBetsPerMonth as $key => $val)
                                    <td class="font-weight-500">{{$totalNumberBetsPerMonth[$key]->sum()}}</td>   
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Number of Bets per DAY
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        @foreach($totalNumberBetsPerDay as $key => $val)
                        @php $decodeValPerDay = json_decode($val) @endphp
                        <thead>
                        	<tr>
                                <th colspan="2" class="text-center">{{$key}}</th>
                            </tr>
                            <tr>
                                <th>Month and Day</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($decodeValPerDay as $keyPD => $valPD)
                            <tr>
                                <td >{{$keyPD}}</td>
                                <td class="text-right">{{$valPD}}</td>
                              
                            </tr>
                            @endforeach
                            <tr>
                                <td class="font-weight-500">Grant Total</td>
                                <td class="font-weight-500 text-right">{{number_format($totalNumberBetsPerDay[$key]->sum())}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>         
    
    <div class="col-xxl-3 col-lg-3">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Number of Bets per arena
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Arena</th>
                                <th>COUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($totalNumberBetsPerArena as $key => $val)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{number_format($val)}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">{{number_format($totalNumberBetsPerArena->sum())}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Amount of Bets per YEAR
            </div>
          	<div class="card-body">
            	<div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>SUM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($totalAmountBetsPerYear as $key => $val)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>₱{{number_format($val,2)}}</td>
                                </tr>
                            @endforeach
                       
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">₱{{number_format($totalAmountBetsPerYear->sum(),2)}}</td>
                            </tr>
                       
                        </tbody>
                    </table>
                </div>
        	</div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Amount of Bets per MONTH
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th rowspan="{{count($yearAndTotalAmountBetsPerMonth)}}">Month</th>
                                <th @if(count($yearAndTotalAmountBetsPerMonth) != 1) class="text-center" @endif colspan="{{count($yearAndTotalAmountBetsPerMonth)}}">Year</th>
                            </tr>
                            <tr>
                            @foreach($yearAndTotalAmountBetsPerMonth as $key => $val)
                                @if(count($yearAndTotalAmountBetsPerMonth) == 1)
                                    <th></th>
                                @endif
                                <th>{{$key}}</th>
                            @endforeach
                            </tr>
                            <tr>
                                @foreach(config('defaults.months') as $month => $monthVals)
                                    <tr>
                                        <td>{{$month}}</td>
                                        @foreach($yearAndTotalAmountBetsPerMonth as $key => $val)
                                                @if(isset($val[$month]))
                                                    <td>₱{{number_format($val[$month],2)}}</td>  
                                                @else
                                                    <td>₱0.00</td>
                                                @endif
                                        
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                @foreach($yearAndTotalAmountBetsPerMonth as $key => $val)
                                    <td class="font-weight-500">₱{{number_format($yearAndTotalAmountBetsPerMonth[$key]->sum(),2)}}</td>   
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Amount of Bets per DAY
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        @foreach($yearAndTotalAmountBetsPerDay as $key => $val)
                        @php $decodeValPerDay = json_decode($val) @endphp
                        <thead>
                        	<tr>
                                <th colspan="2" class="text-center">{{$key}}</th>
                            </tr>
                            <tr>
                                <th>Month and Day</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($decodeValPerDay as $keyPD => $valPD)
                            <tr>
                                <td >{{$keyPD}}</td>
                                <td class="text-right">₱{{number_format($valPD,2)}}</td>
                              
                            </tr>
                            @endforeach
                            <tr>
                                <td class="font-weight-500">Grant Total</td>
                                <td class="font-weight-500 text-right">₱{{number_format($yearAndTotalAmountBetsPerDay[$key]->sum(),2)}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Amount of Bets per arena
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Arena</th>
                                <th>COUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($totalAmountBetsPerArena as $key => $val)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>₱{{number_format($val,2)}}</td>
                                </tr>
                            @endforeach
                       
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">₱{{number_format($totalAmountBetsPerArena->sum(),2)}}</td>
                            </tr>
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>      
</div>
@endsection
