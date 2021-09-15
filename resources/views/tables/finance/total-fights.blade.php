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
    <a href="{{route('dashboard.finance.total-fights')}}" class="btn btn-icon btn-primary btn-outline" title="toggle to dashboard view"><i class="icon wb-dashboard" aria-hidden="true"></i></a>
@endsection

@section('page-content')
<div class="row" data-plugin="matchHeight" data-by-row="true">
    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Fights per YEAR
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
                                <td>17</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Grand Total</td>
                                <td class="font-weight-500">29</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        	</div>
        </div>
    </div>

    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Fights per MONTH
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
    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Fights per DAY
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Day</th>
                                <th>COUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="3">August</td>
                                <td>19</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>23</td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <td>24</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">August Total</td>
                                <td class="font-weight-500 text-right" colspan="2">20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>         
    
    <div class="col-xxl-4 col-lg-4">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Total Number of Fights per arena
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
</div>
@endsection