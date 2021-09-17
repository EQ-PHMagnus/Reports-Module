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
                            <tr>
                                <td>2020</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>2021</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">30</td>
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
                                <th rowspan="2">Month</th>
                                <th colspan="2">Year</th>
                            </tr>
                            <tr>
                                <th>2020</th>
                                <th>2021</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>August</td>
                                <td>8</td>
                                <td>13</td>
                            </tr>
                            <tr>
                                <td>January</td>
                                <td>2</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>March</td>
                                <td>2</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">12</td>
                                <td class="font-weight-500">18</td>
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
                        <thead>
                        	<tr>
                                <th></th>
                                <th colspan="2">Year</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th rowspan="2">Month and Day</th>
                                <th class="text-center">2020</th>
                                <th class="text-center">2021</th>
                                <th class="text-center">Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td >August 19</td>
                                <td class="text-right">1</td>
                                <td class="text-right">1</td>
                                <td class="text-right">2</td>
                            </tr>
                            <tr>
                                <td >August 23</td>
                                <td class="text-right">6</td>
                                <td class="text-right">10</td>
                                <td class="text-right">16</td>
                            </tr>
                            <tr>
                                <td >August 24</td>
                                <td class="text-right">1</td>
                                <td class="text-right">2</td>
                                <td class="text-right">3</td>
                            </tr>
                            <tr>
                                <td >January 1</td>
                                <td class="text-right">2</td>
                                <td class="text-right">2</td>
                                <td class="text-right">4</td>
                            </tr>
                            <tr>
                                <td >March 23</td>
                                <td class="text-right">2</td>
                                <td class="text-right">3</td>
                                <td class="text-right">5</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Grant Total</td>
                                <td class="font-weight-500 text-right">12</td>
                                <td class="font-weight-500 text-right">18</td>
                                <td class="font-weight-500 text-right">30</td>
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
                            <tr>
                                <td>Arena 1</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>Arena 2</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>Arena 3</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>Arena 4</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td>Arena 5</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td>Arena 6</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">30</td>
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
                            <tr>
                                <td>2020</td>
                                <td>₱10,600.00</td>
                            </tr>
                            <tr>
                                <td>2021</td>
                                <td>₱10,600.00</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">₱21,200.00</td>
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
                                <th rowspan="2">Month</th>
                                <th colspan="2">Year</th>
                            </tr>
                            <tr>
                                <th>2020</th>
                                <th>2021</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>August</td>
                                <td>₱9,400.00</td>
                                <td>₱9,100.00</td>
                            </tr>
                            <tr>
                                <td>January</td>
                                <td>₱600.00</td>
                                <td>₱600.00</td>
                            </tr>
                            <tr>
                                <td>March</td>
                                <td>₱600.00</td>
                                <td>₱900.00</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">₱10,600.00</td>
                                <td class="font-weight-500">₱10,600.00</td>
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
                        <thead>
                        	<tr>
                                <th></th>
                                <th colspan="2">Year</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th rowspan="2">Month and Day</th>
                                <th class="text-center">2020</th>
                                <th class="text-center">2021</th>
                                <th class="text-center">Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td >August 19</td>
                                <td class="text-right">₱300.00</td>
                                <td class="text-right">₱500.00</td>
                                <td class="text-right">₱800.00</td>
                            </tr>
                            <tr>
                                <td >August 23</td>
                                <td class="text-right">₱8,800.00</td>
                                <td class="text-right">₱8,000.00</td>
                                <td class="text-right">₱16,800.00</td>
                            </tr>
                            <tr>
                                <td >August 24</td>
                                <td class="text-right">₱300.00</td>
                                <td class="text-right">₱600.00</td>
                                <td class="text-right">₱900.00</td>
                            </tr>
                            <tr>
                                <td >January 1</td>
                                <td class="text-right">₱600.00</td>
                                <td class="text-right">₱600.00</td>
                                <td class="text-right">₱1200.00</td>
                            </tr>
                            <tr>
                                <td >March 23</td>
                                <td class="text-right">₱600.00</td>
                                <td class="text-right">₱900.00</td>
                                <td class="text-right">₱1500.00</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Grant Total</td>
                                <td class="font-weight-500 text-right">₱10,600.00</td>
                                <td class="font-weight-500 text-right">₱10,600.00</td>
                                <td class="font-weight-500 text-right">₱21,200.00</td>
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
                            <tr>
                                <td>Arena 1</td>
                                <td>₱1,000.00</td>
                            </tr>
                            <tr>
                                <td>Arena 2</td>
                                <td>₱2,900.00</td>
                            </tr>
                            <tr>
                                <td>Arena 3</td>
                                <td>₱1,400.00</td>
                            </tr>
                            <tr>
                                <td>Arena 4</td>
                                <td>₱3,500.00</td>
                            </tr>
                            <tr>
                                <td>Arena 5</td>
                                <td>₱11,700.00</td>
                            </tr>
                            <tr>
                                <td>Arena 6</td>
                                <td>₱700.00</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">₱21,200.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>      
</div>
@endsection
