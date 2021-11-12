@extends('commons.layout')
@section('title')
Master Agent Deposits
@endsection

@section('page-title')
Master Agent Deposits
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active">{{$data['content_title'] ?? null}}</li>
@endsection



@section('page-content')
<div class="row">
    <div class="col">
        <!-- type -->
        <input class="filters" type="hidden" name="type" value="{{$data['type'] ?? ''}}">

        @include('filters.for-list')
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{$data['content_title'] ?? null}}</h3>
             
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table  class="table-fit no-view "
                        data-mobile-responsive="true"
                        data-toggle="table"
                        data-ajax="dataRequest"
                        data-search="true"
                        data-side-pagination="server"
                        data-sortable="true"
                        data-detail-formatter="detailFormatter"
                        data-pagination="true"
                        data-sort-order="desc">
                        <thead>
                            <tr>
                                <th  class="text-left" data-field="name">Name </th>
                                @if($data['type'] == 'agent')
                                    <th  class="text-left" data-field="agent_name">Agent Name </th>
                                @endif
                                <th  class="text-left" data-field="amount">Amount</th>
                                <th  class="text-left" data-field="source">Source</th>
                                <th  class="text-left" data-field="source_details">Source Details</th>
                                <th  class="text-left" data-field="date_deposited">Date Deposited</th>
                                <th  class="text-left" data-field="date_approved">Date Approved</th>
                                <th  class="text-left" data-field="status">Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
