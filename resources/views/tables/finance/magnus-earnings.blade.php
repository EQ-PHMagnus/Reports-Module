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
    <a href="{{route('dashboard.finance.magnus-earnings') . '?view=dashboard'}}" class="btn btn-icon btn-primary" title="toggle to dashboard view"><i class="icon wb-dashboard" aria-hidden="true"></i></a>
@endsection

@section('page-content')
<div class="row">
    <div class="col-xxl-6 col-lg-6">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <div class="col-xxl-6 col-lg-6">
                <div class="card card-shadow" >
                    <div class="card-header text-center bg-primary">
                      Total Earnings per MONTH  
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>August</td>
                                        <td>₱490.65</td>
                                    </tr>
                                    <tr>
                                        <td>December</td>
                                        <td>₱12.90</td>
                                    </tr>
                                    <tr>
                                        <td>January</td>
                                        <td>₱10.00</td>
                                    </tr>
                                    <tr>
                                        <td>March</td>
                                        <td>₱20.00</td>
                                    </tr>
                                    <tr>
                                        <td>November</td>
                                        <td>₱39.50</td>
                                    </tr>
                                    <tr>
                                        <td>October</td>
                                        <td>₱603.15</td>
                                    </tr>
                                    <tr>
                                        <td>September</td>
                                        <td>₱38.00</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-500">Grand Total</td>
                                        <td class="font-weight-500">₱1,214.20</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-6 col-lg-6">
                <div class="card card-shadow" >
                    <div class="card-header text-center bg-primary">
                    Total Earnings per YEAR
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>SUM of Magnus earnings (5%)</th>
                                        <th colspan="2">Year</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Month</th>
                                        <th class="text-center">2020</th>
                                        <th class="text-center">2021</th>
                                        <th class="text-center">Grand Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td >August</td>
                                        <td class="text-right">₱96.90</td>
                                        <td class="text-right">₱393.75</td>
                                        <td class="text-right">₱490.65</td>
                                    </tr>
                                    <tr>
                                        <td >December</td>
                                        <td class="text-right"></td>
                                        <td class="text-right">₱12.90</td>
                                        <td class="text-right">₱12.90</td>
                                    </tr>
                                    <tr>
                                        <td >January</td>
                                        <td class="text-right">₱10.00</td>
                                        <td class="text-right"></td>
                                        <td class="text-right">₱10.00</td>
                                    </tr>
                                    <tr>
                                        <td >March</td>
                                        <td class="text-right">₱20.00</td>
                                        <td class="text-right"></td>
                                        <td class="text-right">₱20.00</td>
                                    </tr>
                                    <tr>
                                        <td >November</td>
                                        <td class="text-right"></td>
                                        <td class="text-right">₱39.50</td>
                                        <td class="text-right">₱39.50</td>
                                    </tr>
                                    <tr>
                                        <td >October</td>
                                        <td class="text-right"></td>
                                        <td class="text-right">₱603.15</td>
                                        <td class="text-right">₱603.15</td>
                                    </tr>
                                    <tr>
                                        <td >September</td>
                                        <td class="text-right"></td>
                                        <td class="text-right">₱38.00</td>
                                        <td class="text-right">₱38.00</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-500">Grant Total</td>
                                        <td class="font-weight-500 text-right">₱126.90</td>
                                        <td class="font-weight-500 text-right">₱1,087.30</td>
                                        <td class="font-weight-500 text-right">₱1,214.20</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
                     
            <div class="col-xxl-6 col-lg-6">
                <div class="card card-shadow" >
                    <div class="card-header text-center bg-primary">
                      Total Earnings per Arena  
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Arena</th>
                                        <th>SUM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Arena 1</td>
                                        <td>₱92.00</td>
                                    </tr>
                                    <tr>
                                        <td>Arena 2</td>
                                        <td>₱787.00</td>
                                    </tr>
                                    <tr>
                                        <td>Arena 3</td>
                                        <td>₱50.90</td>
                                    </tr>
                                    <tr>
                                        <td>Arena 4</td>
                                        <td>₱151.55</td>
                                    </tr>
                                    <tr>
                                        <td>Arena 5</td>
                                        <td>₱35.00</td>
                                    </tr>
                                    <tr>
                                        <td>Arena 6</td>
                                        <td>₱97.75</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-500">Grand Total</td>
                                        <td class="font-weight-500">₱1,214.20</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-lg-6">
                <div class="card card-shadow" >
                    <div class="card-header text-center bg-primary">
                      Total Earnings per Fight    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>fight no</th>
                                        <th>SUM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>₱338.55</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>₱85.20</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>₱38.00</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>₱25.00</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>₱109.30</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>₱575.00</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>₱33.15</td>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td>₱10.00</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-500">Grand Total</td>
                                        <td class="font-weight-500">₱1,214.20</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
    </div>
    <div class="col-xxl-6 col-lg-6">
        <div class="col">
            <div class="card card-shadow" >
                <div class="card-header text-center bg-primary">
                  Total Earnings per DAY
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Day</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="9">August</td>
                                    <td>2</td>
                                    <td>₱25.00</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>₱5.00</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>₱39.50</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>₱25.00</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>₱4.50</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>₱7.90</td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td>₱5.00</td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td>₱31.95</td>
                                </tr>
                                <tr>
                                    <td>23</td>
                                    <td>₱361.80</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-500" colspan="2">August Total</td>
                                    <td class="font-weight-500 text-right">₱490.65</td>
                                </tr>
                                <tr>
                                    <td>December</td>
                                    <td>23</td>
                                    <td>₱12.90</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-500" colspan="2">December Total</td>
                                    <td class="font-weight-500 text-right">₱12.90</td>
                                </tr>
                                <tr>
                                    <td>January</td>
                                    <td>1</td>
                                    <td>₱10.00</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-500" colspan="2">January Total</td>
                                    <td class="font-weight-500 text-right">₱10.00</td>
                                </tr>
                                <tr>
                                    <td>March</td>
                                    <td>23</td>
                                    <td>₱20.00</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-500" colspan="2">March Total</td>
                                    <td class="font-weight-500 text-right">₱20.00</td>
                                </tr>
                                <tr>
                                    <td>November</td>
                                    <td>23</td>
                                    <td>₱39.50</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-500" colspan="2">November Total</td>
                                    <td class="font-weight-500 text-right">₱39.50</td>
                                </tr>
                                <tr>
                                    <td>October</td>
                                    <td>23</td>
                                    <td>₱603.15</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-500" colspan="2">October Total</td>
                                    <td class="font-weight-500 text-right">₱603.15</td>
                                </tr>
                                <tr>
                                    <td>September</td>
                                    <td>23</td>
                                    <td>₱38.00</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-500" colspan="2">September Total</td>
                                    <td class="font-weight-500 text-right">₱38.00</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-500" >Grand Total</td>
                                    <td class="font-weight-500 text-right"colspan="2">₱1,214.20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

@endsection
