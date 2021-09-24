@extends('commons.layout')
@section('title')
Super Agent Accounts
@endsection

@section('page-title')
Super Agent Accounts
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item breadcrumb-arrow">Finance Reports</li>
<li class="breadcrumb-item active">Super Agent Accounts</li>
@endsection

@section('page-header-actions')
    {{-- <a href="{{route('dashboard.finance.super-agent-accounts') . '?view=dashboard'}}" class="btn btn-icon btn-primary" title="toggle to dashboard view"><i class="icon wb-dashboard" aria-hidden="true"></i></a> --}}
@endsection

@section('page-content')
<div class="row">
    <div class="col-xxl-6 col-lg-6">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <div class="col-xxl-6 col-lg-6">
                <div class="card card-shadow" >
                    <div class="card-header text-center bg-primary">
                      Agent Account Cash In/Out           
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Agent Account</th>
                                        <th>Cash In</th>
                                        <th>Cash Out</th>
                                        <th>Grand Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>101 agent</td>
                                        <td>₱2,800</td>
                                        <td>₱9,900</td>
                                        <td>₱12,700</td>
                                    </tr>
                                    <tr>
                                        <td>Age Ent</td>
                                        <td></td>
                                        <td>₱13,200</td>
                                        <td>₱13,200</td>
                                    </tr>
                                    <tr>
                                        <td>Ageeent</td>
                                        <td></td>
                                        <td>₱8,500</td>
                                        <td>₱8,500</td>
                                    </tr>
                                    <tr>
                                        <td>agent</td>
                                        <td>₱19,100</td>
                                        <td></td>
                                        <td>₱19,100</td>
                                    </tr>
                                    <tr>
                                        <td>agent ABC</td>
                                        <td></td>
                                        <td>₱22,600</td>
                                        <td>₱22,600</td>
                                    </tr>
                                    <tr>
                                        <td>Ten Age</td>
                                        <td></td>
                                        <td>₱11,700</td>
                                        <td>₱11,700</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-500">Grand Total</td>
                                        <td class="font-weight-500">₱21,900</td>
                                        <td class="font-weight-500">₱65,900</td>
                                        <td class="font-weight-500">₱87,800</td>
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
                    Super Agent Account Cash In/Out         
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Agent Account</th>
                                        <th>Cash In</th>
                                        <th>Cash Out</th>
                                        <th>Grand Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Soup Agent</td>
                                        <td>₱2,800</td>
                                        <td>₱31,600</td>
                                        <td>₱34,400</td>
                                    </tr>
                                    <tr>
                                        <td>Superman Agent</td>
                                        <td>₱19,100</td>
                                        <td>₱34,300</td>
                                        <td>₱53,400</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-500">Grand Total</td>
                                        <td class="font-weight-500">₱21,900</td>
                                        <td class="font-weight-500">₱65,900</td>
                                        <td class="font-weight-500">₱87,800</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection
