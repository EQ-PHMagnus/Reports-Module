@extends('commons.layout')
@section('title')
Tax Computations
@endsection

@section('page-title')
Tax Computations
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Finance Reports</li>
<li class="breadcrumb-item active">Tax Computations</li>
@endsection

@section('page-header-actions')
    {{-- <a href="{{route('dashboard.finance.super-agent-accounts') . '?view=dashboard'}}" class="btn btn-icon btn-primary" title="toggle to dashboard view"><i class="icon wb-dashboard" aria-hidden="true"></i></a> --}}
@endsection

@section('page-content')
<div class="row">
    <div class="col-xxl-3 col-xs-12">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Gross Receipts from Bets          
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" border="0">
                        <tbody>
                            <tr>
                                <td class="">Total Amount of bets</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($grb['tb'], 4)}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>*</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500 text-right" colspan="2">.05</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">GRB (Total Bets x 5%)</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($grb['grb'], 4)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xs-12">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              Breakdown of GRB           
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" border="0">
                        <tbody>
                            <tr>
                                <td class="">Gross Revenue (GRB/1.12)</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($grb_breakdown['gr'], 4)}}</td>
                            </tr>
                            <tr>
                                <td class="">Add: Vat (GR *.12)</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($grb_breakdown['vat'], 4)}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">Total GRB (GR + VAT)</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($grb_breakdown['total_grb'], 4)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-xs-12">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              On Gross Commission (GC)         
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" border="0">
                        <tbody>
                            <tr>
                                <td class="">If basis is from GR (GR * .02)</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($on_gc['gr'], 4)}}</td>
                            </tr>
                            <tr>
                                <td class="">If basis is from Total Bets (TB * .02)</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($on_gc['tb'], 4)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xxl-3 col-xs-12">
        <div class="card card-shadow" >
            <div class="card-header text-center bg-primary">
              On Net Commission (NC)         
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" border="0">
                        <tbody>
                            <tr>
                                <td class="font-weight-500" colspan="2">If basis is from GR </td>
                            </tr>
                            <tr>
                                <td class="">GC</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($on_nc['gr']['gc'], 4)}}</td>
                            </tr>
                            <tr>
                                <td class="">Less: 10% Withholding</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($on_nc['gr']['withholding'], 4)}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">NC</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($on_nc['gr']['nc'], 4)}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500" colspan="2">If basis is from TB </td>
                            </tr>
                            <tr>
                                <td class="">GC</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($on_nc['tb']['gc'], 4)}}</td>
                            </tr>
                            <tr>
                                <td class="">Less: 10% Withholding</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($on_nc['tb']['withholding'], 4)}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-500">NC</td>
                                <td class="font-weight-500 text-right">{{moneyFormat($on_nc['tb']['nc'], 4)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
